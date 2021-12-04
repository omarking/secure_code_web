import 'dart:async';
import 'dart:convert';
import 'package:email_validator/email_validator.dart';
import 'package:prueba/src/login_page.dart';
import 'package:location/location.dart' as lc;
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:prueba/src/tipoUsuario.dart';
import 'package:shared_preferences/shared_preferences.dart';

class Registrar extends StatefulWidget {
  @override
  _coordenadas createState() => _coordenadas();
}

const default_location = LatLng(27.037486, -103.685334);

class _coordenadas extends State<Registrar> {
  TextEditingController nombre = TextEditingController();
  TextEditingController ape1 = TextEditingController();
  TextEditingController ape2 = TextEditingController();
  TextEditingController fechaN = TextEditingController();
  TextEditingController tel = TextEditingController();
  TextEditingController calle = TextEditingController();
  TextEditingController numero = TextEditingController();
  TextEditingController codigoP = TextEditingController();
  TextEditingController colonia = TextEditingController();
  TextEditingController municipio = TextEditingController();
  TextEditingController correo = TextEditingController();
  TextEditingController user = TextEditingController();
  TextEditingController pass = TextEditingController();
  TextEditingController confpass = TextEditingController();
  TextEditingController dateController = TextEditingController();

  var idusuario = 2;
  MapType mapType = MapType.normal;
  BitmapDescriptor icon;
  GoogleMapController controller;
  lc.Location location;
  bool myLocationEnabled = false;
  bool myLocationButtonEnabled = false;
  LatLng currentLocation = default_location;
  String lat = '';
  String long = '';
  Set<Marker> makers = Set<Marker>();
  List statesList;
  String _myState;
  String _dropdownError;
  List statesList1;
  String _myState1;
  String _dropdownError1;
  var iduser;
  bool isvalid = false;

  final _formKey = GlobalKey<FormState>();
  final globalKey = GlobalKey<ScaffoldState>();

  Future<String> _getStateList() async {
    final response = await http.post(
        "http://192.168.1.71:80/locateme_back/mostrarColonias.php",
        body: {});
    var datauser = json.decode(response.body);
    setState(() {
      statesList = datauser;
    });
  }

  Future<String> _getStateList1() async {
    final response = await http.post(
        "http://192.168.1.71:80/locateme_back/mostrarRoles.php",
        body: {});
    var datauser = json.decode(response.body);
    setState(() {
      statesList1 = datauser;
    });
  }

  @override
  void dispose() {
    dateController.dispose();
    super.dispose();
  }

  void _validateForm() {
    bool _isValid = _formKey.currentState.validate();
    bool _isValid1 = _formKey.currentState.validate();
    if (_myState == null && _myState1 == null) {
      print('nulo ambos');
      setState(() => _dropdownError1 = 'Requerido');
      _isValid1 = false;
      setState(() => _dropdownError = 'Requerido');
      _isValid = false;
    } else if (_myState == null && _myState1 != null) {
      print('nulo colonia');
      setState(() => _dropdownError = 'Requerido');
      _isValid = false;
    } else if (_myState != null && _myState1 == null) {
      print('nulo rol');
      setState(() => _dropdownError1 = 'Requerido');
      _isValid1 = false;
      // registrarUsuario();
      // registrarColonia();
      // _validateForm1();
    } else {
      print('Estan llenos ambos');
      registrarUsuario();
    }
    // print(_myState);
  }

  //   void _validateForm1() {
  //   bool _isValid1 = _formKey.currentState.validate();

  //   if (_myState1 == null) {
  //     setState(() => _dropdownError1 = 'Requerido');
  //     _isValid1 = false;
  //   } else {
  // // registrar();
  //   }
  //     // print(_myState);
  //   }

  Future<String> registrarUsuario() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/registrarUser.php", body: {
//final response = await http.post("http://locateme.codewaymx.com/registrarUser.php", body: {
      "nombre": nombre.text,
      "apellidoUno": ape1.text,
      "apellidoDos": ape2.text,
      "fechaNac": dateController.text,
      "telefono": tel.text,
      "calle": calle.text,
      "numero": numero.text,
      "email": correo.text,
      "usuario": user.text,
      "contrasenia": pass.text,
    });
    var datauser = json.decode(response.body);
    setState(() {
      if (datauser[0]['correo'] == '1') {
        print('1. registra usuario');
        registrarColonia();
      } else {
        print(datauser);
        ScaffoldMessenger.of(context).showSnackBar(SnackBar(
          content: const Text('El correo ya está registrado, ingrese otro'),
        ));
        correo.text = '';
      }
    });
  }

  void registrarColonia() {
    http.post('http://192.168.1.71:80/locateme_back/guardarColonia.php', body: {
      'col': _myState,
      'email': correo.text,
    });
    setState(() {
      print('2. registra colonia');
      registrar();
    });
  }

  void registrar() {
    http.post("http://192.168.1.71:80/locateme_back/ubicacionUser.php", body: {
      'email': correo.text,
      'lat': "$lat",
      'long': "$long",
    });
    setState(() sync* {
      print('3. registra ubicacion usuario');
      Roles();
    });
  }

  void Roles() {
    http.post("http://192.168.1.71:80/locateme_back/registrarRoles.php", body: {
      'rol': _myState1,
      'email': correo.text,
    });
    setState(() {
      print('4. registra el rol');
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(
        content: const Text('Se registró correctamente'),
        action: SnackBarAction(
            label: 'Iniciar sesión',
            onPressed: () {
              Navigator.push(context,
                  MaterialPageRoute(builder: (context) => LoginPage()));
            }),
      ));
      statesList = null;
      statesList1 = null;
      nombre.text = '';
      ape1.text = '';
      ape2.text = '';
      dateController.text = '';
      tel.text = '';
      calle.text = '';
      numero.text = '';
      correo.text = '';
      user.text = '';
      pass.text = '';
      confpass.text = '';

//   if(_myState==1){
//     Navigator.push(context,
//             MaterialPageRoute(
//                builder: (context) => Usuario1Page()));
//   }else{
// Navigator.push(context,
//             MaterialPageRoute(
//                builder: (context) => Usuario2Page()));
//   }
    });
  }

  @override
  void initState() {
    // getIcons();
    requestPerms();
    _getStateList();
    _getStateList1();
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

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Registro"), //<Widget>[]
        backgroundColor: Color.fromRGBO(0, 74, 173, 1.0),
        elevation: 70.0,

        leading: Image(
          image: AssetImage('assets/logoMod.png'),
        ), //IconButton
        brightness: Brightness.dark,
      ),
      body: Stack(
        // key: _formKey,
        children: <Widget>[
          _crearFondo(context),
          _loginForm(context),
        ],
      ),
    );
  } //  _botonEnviarA(context),

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
                      // height: 180.0,
                      ),
                ),
                Container(
                  width: size.width * 0.85,
                  margin: EdgeInsets.symmetric(vertical: 10.0),
                  padding: EdgeInsets.symmetric(vertical: 50.0),
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
                      // Stroked text as border.
                      Text(
                        'Registrate',
                        style: TextStyle(
                          fontSize: 30,
                          foreground: Paint()
                            ..style = PaintingStyle.stroke
                            ..strokeWidth = 3
                            ..color = Colors.blue[700],
                        ),
                      ),
                      _nombre(),
                      _apellidoUno(),
                      _apellidoDos(),
                      //  _fechaNac(),
                      _DatePicker(),
                      _telefono(),
                      _calle(),
                      _numero(),
                      _ComboCol(),
                      _ComboRol(),
                      _correo(),
                      _usuario(),
                      _contrasenia(),
                      _confirmarC(),
                      SizedBox(height: 20.0),
                      _botonGuardar(context),
                      SizedBox(height: 20.0),
                      _botonCancelar(context),
                    ],
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _nombre() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        keyboardType: TextInputType.name,
        textInputAction: TextInputAction.next,
        controller: nombre,
        validator: (value) {
          if (value.isEmpty) {
            return 'El nombre es requerido';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.supervised_user_circle, color: Colors.blueAccent),
          // hintText: 'Escribe tu nombre',
          labelText: 'Nombre',
        ),
      ),
    );
  }

  Widget _apellidoUno() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        keyboardType: TextInputType.text,
        textInputAction: TextInputAction.next,
        controller: ape1,
        validator: (value) {
          if (value.isEmpty) {
            return 'El primer apellido es requerido';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.supervised_user_circle_outlined,
              color: Colors.blueAccent),
          // hintText: 'Primer apellido',
          labelText: 'Primer apellido',
        ),
      ),
    );
  }

  Widget _apellidoDos() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        keyboardType: TextInputType.text,
        textInputAction: TextInputAction.next,
        controller: ape2,
        validator: (value) {
          if (value.isEmpty) {
            return 'El segundo apellido es requerido';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.supervised_user_circle_sharp,
              color: Colors.blueAccent),
          // hintText: 'ejemplo@correo.com',
          labelText: 'Segundo apellido',
        ),
      ),
    );
  }

  Widget _fechaNac() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        keyboardType: TextInputType.datetime,
        textInputAction: TextInputAction.next,
        controller: fechaN,
        validator: (value) {
          if (value.isEmpty) {
            return 'La fecha de nacimiento es requerida';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.calendar_today, color: Colors.blueAccent),
          hintText: 'aaaa-mm-dd',
          labelText: 'Fecha de nacimiento',
        ),
      ),
    );
  }

  Widget _DatePicker() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        readOnly: true,
        controller: dateController,
        validator: (value) {
          if (value.isEmpty) {
            return 'La fecha de nacimiento es requerida';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.calendar_today, color: Colors.blueAccent),
          hintText: 'aaaa-mm-dd',
          labelText: 'Fecha de nacimiento',
        ),
        onTap: () async {
          var date = await showDatePicker(
              context: context,
              initialDate: DateTime.now(),
              firstDate: DateTime(1900),
              lastDate: DateTime(2100));
          dateController.text = date.toString().substring(0, 10);
        },
      ),
    );
  }

  Widget _telefono() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        keyboardType: TextInputType.number,
        textInputAction: TextInputAction.next,
        controller: tel,
        maxLength: 10,
        validator: (value) {
          if (value.isEmpty) {
            return 'El número de teléfono es requerido';
          }
          if (value.length < 10) {
            return 'El número de celular es de 10 dígitos';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.phone, color: Colors.blueAccent),
          // hintText: 'ejemplo@correo.com',
          labelText: 'Teléfono',
        ),
      ),
    );
  }

  Widget _calle() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        keyboardType: TextInputType.text,
        textInputAction: TextInputAction.next,
        controller: calle,
        validator: (value) {
          if (value.isEmpty) {
            return 'El nombre de la calle es requerido';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.streetview, color: Colors.blueAccent),
          // hintText: 'ejemplo@correo.com',
          labelText: 'Calle',
        ),
      ),
    );
  }

  Widget _numero() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        keyboardType: TextInputType.text,
        textInputAction: TextInputAction.next,
        controller: numero,
        // maxLines: 10,
        validator: (value) {
          if (value.isEmpty) {
            return 'El número de casa es requerido';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.label, color: Colors.blueAccent),
          // hintText: 'ejemplo@correo.com',
          labelText: 'Número',
        ),
      ),
    );
  }

  Widget _ComboCol() {
    return Container(
        padding: EdgeInsets.symmetric(horizontal: 20.0, vertical: 10),
        child: Row(
          //  crossAxisAlignment: CrossAxisAlignment.center,

          // mainAxisAlignment: MainAxisAlignment.spaceEvenly,
          // mainAxisSize: MainAxisSize.min,
          children: <Widget>[
            Icon(Icons.add_alert, color: Colors.blueAccent),
            DropdownButtonHideUnderline(
              child: ButtonTheme(
                child: DropdownButton<String>(
                  value: _myState,
                  iconSize: 30,
                  icon: (null),
                  style: TextStyle(
                    color: Colors.black54,
                    fontSize: 16,
                  ),
                  hint: Text('    Selecciona tu colonia'),
                  onChanged: (String newValue) {
                    setState(() {
                      _myState = newValue;
                      _dropdownError = null;
                      print(_myState);
                    });
                  },
                  items: statesList?.map((item) {
                        return new DropdownMenuItem(
                          child: Text(item['colNombre']),
                          value: item['idColonia'].toString(),
                        );
                      })?.toList() ??
                      [],
                ),
              ),
            ),
            _dropdownError == null
                ? SizedBox.shrink()
                : Text(
                    _dropdownError ?? "",
                    style: TextStyle(color: Colors.red),
                  ),
          ],
        ));
  }

  Widget _ComboRol() {
    return Container(
        padding: EdgeInsets.symmetric(horizontal: 20.0),
        child: Row(
          // mainAxisAlignment: MainAxisAlignment.spaceEvenly,
          children: <Widget>[
            Icon(Icons.add_alert, color: Colors.blueAccent),
            DropdownButtonHideUnderline(
              child: ButtonTheme(
                child: DropdownButton<String>(
                  value: _myState1,
                  iconSize: 30,
                  icon: (null),
                  style: TextStyle(
                    color: Colors.black54,
                    fontSize: 16,
                  ),
                  hint: Text('    Tipo de usuario'),
                  onChanged: (String newValue) {
                    setState(() {
                      _myState1 = newValue;
                      _dropdownError1 = null;
                      print(_myState1);
                    });
                  },
                  items: statesList1?.map((item) {
                        return new DropdownMenuItem(
                          child: Text(item['rol_descripcion']),
                          value: item['idroles'].toString(),
                        );
                      })?.toList() ??
                      [],
                ),
              ),
            ),
            _dropdownError1 == null
                ? SizedBox.shrink()
                : Text(
                    _dropdownError1 ?? "",
                    style: TextStyle(color: Colors.red),
                  ),
          ],
        ));
  }

  Widget _correo() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        keyboardType: TextInputType.emailAddress,
        textInputAction: TextInputAction.next,
        controller: correo,
        validator: (value) {
          if (value.isEmpty) {
            return 'El correo es requerido';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.verified_user_rounded, color: Colors.blueAccent),
          hintText: 'ejemplo@correo.com',
          labelText: 'Correo',
        ),
      ),
    );
  }

  Widget _usuario() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        keyboardType: TextInputType.text,
        textInputAction: TextInputAction.next,
        controller: user,
        validator: (value) {
          if (value.isEmpty) {
            return 'El nombre de usuario es requerido';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.verified_user_rounded, color: Colors.blueAccent),
          hintText: 'usuario12',
          labelText: 'Usuario',
        ),
      ),
    );
  }

  Widget _contrasenia() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        keyboardType: TextInputType.visiblePassword,
        textInputAction: TextInputAction.next,
        controller: pass,
        validator: (value) {
          if (value.isEmpty) {
            return 'El nombre de la calle es requerido';
          }
          if (value.length < 9) {
            return 'Debe ser mayor a 8 digitos';
          }
        },
        obscureText: true,
        decoration: InputDecoration(
          icon: Icon(Icons.lock_outline, color: Colors.blueAccent),
          hintText: '*********',
          labelText: 'Contraseña',
        ),
      ),
    );
  }

  String validatePassword(String value) {
    Pattern pattern = r'^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$';
    RegExp regex = new RegExp(pattern);
    print(value);
    if (value.isEmpty) {
      return 'La contraseña es requerida';
    } else {
      if (!regex.hasMatch(value))
        return 'Ingresa una contraseña válida';
      else
        return null;
    }
  }

  Widget _confirmarC() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        controller: confpass,
        keyboardType: TextInputType.visiblePassword,
        validator: (value) {
          if (value.isEmpty) {
            return 'La confirmacion de contraseña es requerida';
          }
        },
        obscureText: true,
        decoration: InputDecoration(
          icon: Icon(Icons.lock_outline, color: Colors.blueAccent),
          hintText: '********',
          labelText: 'Confirmar contraseña',
        ),
      ),
    );
  }

  Widget _botonGuardar(BuildContext context) {
    return ElevatedButton(
      onPressed: () {
        //  validatePassword(pass.text);
        if (_formKey.currentState.validate()) {
          isvalid = EmailValidator.validate(correo.text);
          if (isvalid) {
            if (pass.text != confpass.text) {
              ScaffoldMessenger.of(context).showSnackBar(
                SnackBar(
                  content: const Text('Las contraseñas no coinciden'),
                ),
              );
              pass.text = '';
              confpass.text = '';
            } else {
              _validateForm();
            }
          } else {
            ScaffoldMessenger.of(context).showSnackBar(
              SnackBar(
                content: const Text('El correo es inválido'),
              ),
            );
            correo.text = '';
          }
        }
        ;
      },
      child: Text('Guardar'),
      style: ElevatedButton.styleFrom(
          primary: Color.fromRGBO(0, 74, 173, 1.0),
          padding: EdgeInsets.symmetric(horizontal: 100.0, vertical: 15.0),
          textStyle: TextStyle(

              // fontSize: 20,
              fontWeight: FontWeight.bold)),
    );
  }

  Widget _botonCancelar(BuildContext context) {
    return RaisedButton(
      child: Container(
        padding: EdgeInsets.symmetric(horizontal: 80.0, vertical: 15.0),
        child: Text('Cancelar'),
      ),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(6.0)),
      color: Color.fromRGBO(0, 74, 173, 1.0),
      textColor: Colors.white,
      onPressed: () {
        return Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => LoginPage(),
          ),
        );
      },
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
          padding: EdgeInsets.only(top: 10.0),
          child: Column(
            children: <Widget>[
              // Image(image: AssetImage('assets/logoMod.png')),
              SizedBox(height: 10.0, width: double.infinity),
            ],
          ),
        ),
      ],
    );
  }

  Widget _botonDoble(BuildContext context) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
      children: <Widget>[
        TextFormField(
          scrollPadding: EdgeInsets.symmetric(horizontal: 20.0, vertical: 15.0),
          keyboardType: TextInputType.text,
          controller: calle,
          validator: (value) {
            if (value.isEmpty) {
              return 'El nombre de la calle es requerido';
            }
          },
          decoration: InputDecoration(
            icon: Icon(Icons.streetview, color: Colors.blueAccent),
            // hintText: 'ejemplo@correo.com',
            labelText: 'Calle',
          ),
        ),
        TextFormField(
          scrollPadding: EdgeInsets.symmetric(horizontal: 20.0, vertical: 15.0),
          keyboardType: TextInputType.text,
          controller: numero,
          // maxLines: 10,
          validator: (value) {
            if (value.isEmpty) {
              return 'El número de casa es requerido';
            }
          },
          decoration: InputDecoration(
            icon: Icon(Icons.label, color: Colors.blueAccent),
            // hintText: 'ejemplo@correo.com',
            labelText: 'Número',
          ),
        ),
      ],
    );
  }
}
