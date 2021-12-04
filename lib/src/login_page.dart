import 'dart:async';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:http/http.dart' as http;
import 'package:permission_handler/permission_handler.dart';
import 'package:prueba/src/Splashscreen.dart';
import 'package:prueba/src/recuperarContrasenia.dart';
import 'package:prueba/src/ubicacion_page.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:location/location.dart' as lc;

String correo = '';
lc.Location location;
bool myLocationEnabled = false;
bool myLocationButtonEnabled = false;
LatLng currentLocation = default_location;
String lat = '';
String long = '';

class LoginPage extends StatefulWidget {
  @override
  _LoginPageState createState() => new _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _formKey = GlobalKey<FormState>();
  // SharedPreferences sharedPreferences;
  // SharedPreferences.Editor editor;
  TextEditingController user = new TextEditingController();
  TextEditingController pass = new TextEditingController();

  String msg = '';

  @override
  void initState() {
    super.initState();
    requestPerms();
    print('Este es desde el login lo primero que se ejecuta $finalEmail');
  }

  getLocation() async {
    var currentLocation = await location.getLocation();
    updateLocation(currentLocation);
  }

  updateLocation(currentLocation) async {
    if (currentLocation != null) {
      lat = '${currentLocation.latitude}';
      long = '${currentLocation.longitude}';
    }
  }

  LocationChange() {
    location.onLocationChanged.listen((lc.LocationData cLoc) {
      if (cLoc != null) updateLocation(cLoc);
    });
  }

  requestPerms() async {
    Map<Permission, PermissionStatus> statuses =
        await [Permission.locationAlways].request();

    var status = statuses[Permission.locationAlways];
    if (status == PermissionStatus.denied) {
      requestPerms();
    } else {
      enableGPS();
    }
  }

  enableGPS() async {
    location = lc.Location();
    bool serviceStatusResult = await location.requestService();
    if (!serviceStatusResult) {
      enableGPS();
    } else {
      UpdateStatus();
      getLocation();
      // LocationChange();
    }
  }

  UpdateStatus() {
    setState(() {
      myLocationButtonEnabled = true;
      myLocationEnabled = true;
    });
  }

  Future<String> ubicacionGuardada() async {
    final response = await http.post(
        "http://192.168.1.71:80/locateme_back/ubicacionGuardada.php",
        body: {
//final response = await http.post("http://locateme.codewaymx.com/ubicacionGuardada.php",body: {
          'correo': user.text,
        });
    var datauser = json.decode(response.body);
    double latit = double.parse(datauser[0]);
    double longit = double.parse(datauser[1]);
    final SharedPreferences sharedPreferences =
        await SharedPreferences.getInstance();
    sharedPreferences.setDouble('latit', latit);
    sharedPreferences.setDouble('longit', longit);
    print(datauser);
    setState(() {
      print(' Este es la latitud desde login $latit');
      print(longit);
    });
  }

  Future<List> _loginUser() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/loginUser.php", body: {
      //final response = await http.post('http://locateme.codewaymx.com/loginUser.php', body: {
      "correo": user.text,
      "contrasenia": pass.text,
    });

    var datauser = json.decode(response.body);
    if (datauser.length == 0) {
      setState(() {
        showDialog(
          context: context,
          builder: (BuildContext context) {
            return AlertDialog(
              title: Text('Correo o contraseña incorrecta'),
              actions: <Widget>[
                ElevatedButton(
                  child: Text("OK"),
                  onPressed: () {
                    user.text = '';
                    pass.text = '';
                    Navigator.of(context).pop();
                  },
                ),
              ],
            );
          },
        );
      });
    } else {
      final SharedPreferences sharedPreferences =
          await SharedPreferences.getInstance();
      sharedPreferences.setString('email', user.text);
      Navigator.push(
          context, MaterialPageRoute(builder: (context) => SplashScreen()));
      print(datauser);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: <Widget>[
          _crearFondo(context),
          _loginForm(context),
        ],
      ),
    );
  }

  Widget _loginForm(BuildContext context) {
    final size = MediaQuery.of(context).size;

    return SingleChildScrollView(
        child: Column(
      children: <Widget>[
        Form(
          key: _formKey,
          child: Column(
            children: <Widget>[
              SafeArea(
                child: Container(
                  height: 180.0,
                ),
              ),
              Container(
                width: size.width * 0.85,
                margin: EdgeInsets.symmetric(vertical: 30.0),
                padding: EdgeInsets.symmetric(vertical: 55.0),
                decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(5.0),
                    boxShadow: <BoxShadow>[
                      BoxShadow(
                        color: Colors.black26,
                        blurRadius: 3.0,
                        offset: Offset(0.0, 5.0),
                        spreadRadius: 3.0,
                      )
                    ]),
                child: Column(
                  children: <Widget>[
                    // key: _formkey,
                    Text(
                      'Iniciar sesión',
                      style: TextStyle(
                        fontSize: 25,
                        foreground: Paint()
                          ..style = PaintingStyle.stroke
                          ..strokeWidth = 3
                          ..color = Colors.blue[700],
                      ),
                    ),
                    SizedBox(height: 20.0),
                    _correoE(),
                    SizedBox(height: 20.0),
                    _contrasenia(),
                    SizedBox(height: 30.0),
                    _botonDoble(context),
                  ],
                ),
              ),
              Container(
                width: size.width * 0.5,
                decoration: BoxDecoration(
                    color: Color(0xFFF4F4F4),
                    borderRadius: BorderRadius.all(Radius.circular(9.0)),
                    shape: BoxShape.rectangle,
                    boxShadow: <BoxShadow>[
                      BoxShadow(
                        color: Colors.white,
                        blurRadius: 5.0,
                        offset: Offset(-4, -4),
                        spreadRadius: 2.0,
                      ),
                      BoxShadow(
                        color: Colors.grey.shade300,
                        blurRadius: 5.0,
                        offset: Offset(4, 4),
                        spreadRadius: 1.0,
                      ),
                    ]),
                child: FlatButton(
                    onPressed: () {
                      return Navigator.push(
                          context,
                          MaterialPageRoute(
                              builder: (context) => RecuperarPass())
                          // builder: (context) => RegistrarPage())
                          );
                    },
                    child: Text('¿Olvidó la contraseña?')),
              ),
              // )
            ],
          ),
        ),
      ],
    ));
  }

  Widget _correoE() {
    var inputDecoration = InputDecoration(
      icon: Icon(Icons.alternate_email, color: Colors.blueAccent),
      hintText: 'ejemplo@correo.com',
      labelText: 'Correo electrónico',
    );
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        controller: user,
        keyboardType: TextInputType.emailAddress,
        textInputAction: TextInputAction.next,
        validator: (value) {
          if (value.isEmpty) {
            return 'El correo electrónico es requerido';
          }
        },
        decoration: inputDecoration,
      ),
    );
  }

  Widget _contrasenia() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        controller: pass,
        // ignore: missing_return
        validator: (value) {
          if (value.isEmpty) {
            return 'La contraseña es requerida';
          }
        },
        obscureText: true,
        decoration: InputDecoration(
          icon: Icon(Icons.lock_outline, color: Colors.blueAccent),
          hintText: '********',
          labelText: 'Contraseña',
        ),
      ),
    );
  }

  Widget _botonDoble(BuildContext context) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
      children: <Widget>[
        RaisedButton(
          padding: EdgeInsets.symmetric(horizontal: 30.0, vertical: 15.0),
          splashColor: Colors.grey,
          child: Row(
            mainAxisSize: MainAxisSize.min,
            // mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: <Widget>[
              Icon(
                Icons.login_outlined,
                color: Colors.white,
              ),
              Text(
                'Entrar',
                style: TextStyle(
                  fontSize: 20,
                  fontWeight: FontWeight.w700,
                  color: Colors.white,
                ),
              ),
            ],
          ),
          shape:
              RoundedRectangleBorder(borderRadius: BorderRadius.circular(6.0)),
          color: Color.fromRGBO(0, 74, 173, 1.0),
          textColor: Colors.white,
          onPressed: () {
            if (_formKey.currentState.validate()) {
              // Scaffold.of(context).showSnackBar(SnackBar(content: Text('Bienvenido')));
              requestPerms();
              ubicacionGuardada();
              _loginUser();
            }
          },
        ),
        RaisedButton(
          padding: EdgeInsets.symmetric(horizontal: 15.0, vertical: 15.0),
          splashColor: Colors.grey,
          child: Row(
            mainAxisSize: MainAxisSize.min,
            // mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: <Widget>[
              Icon(
                Icons.add,
                color: Colors.white,
              ),
              Text(
                'Registrar',
                style: TextStyle(
                  fontSize: 20,
                  fontWeight: FontWeight.w700,
                  color: Colors.white,
                ),
              ),
            ],
          ),
          shape:
              RoundedRectangleBorder(borderRadius: BorderRadius.circular(6.0)),
          color: Color.fromRGBO(0, 74, 173, 1.0),
          textColor: Colors.white,
          onPressed: () {
            return Navigator.push(
                context, MaterialPageRoute(builder: (context) => Registrar())
                // builder: (context) => RegistrarPage())
                );
            // registrar();
          },
        ),
      ],
    );
  }

  Widget _crearFondo(BuildContext context) {
    final size = MediaQuery.of(context).size;

    final fondo = Container(
      height: size.height * 0.4,
      width: double.infinity,
      decoration: BoxDecoration(
        color: Color.fromRGBO(0, 74, 173, 1.0),
      ),
    );

    final circulo = Container(
      width: 100.0,
      height: 100.0,
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(100.0),
        color: Color.fromRGBO(255, 255, 255, 0.05),
      ),
    );

    return Stack(
      children: <Widget>[
        fondo,
        Positioned(top: 90.0, left: 30.0, child: circulo),
        Positioned(top: 110.0, right: 90.0, child: circulo),
        Positioned(top: -40.0, right: -30.0, child: circulo),
        Positioned(top: -35.0, left: 120.0, child: circulo),
        Container(
          padding: EdgeInsets.only(top: 40.0),
          child: Column(
            children: <Widget>[
              Image(image: AssetImage('assets/logoMod.png')),
              SizedBox(height: 10.0, width: double.infinity),
            ],
          ),
          // decoration: BoxDecoration(
          //  image: DecorationImage(
          //   image: AssetImage('img/logo.png'),
          // )
          // )
        ),
      ],
    );
  }
}
