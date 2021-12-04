import 'dart:convert';
import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/services.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:prueba/push_notification.dart';
import 'package:prueba/src/Splashscreen.dart';
import 'package:prueba/src/login_page.dart';
import 'package:prueba/src/perfil_page.dart';
import 'package:location/location.dart' as lc;
import 'package:permission_handler/permission_handler.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:prueba/src/sizes_helpers.dart';

class PruebaMapa extends StatefulWidget {
  @override
  _registrarPageState createState() => new _registrarPageState();
}
// const default_location=LatLng(19.926738, -99.345431);

class _registrarPageState extends State<PruebaMapa> {
  FirebaseMessaging _messaging = FirebaseMessaging();

  PushNotification _notificationInfo;

  int _totalNotifications;

  final _formKey = GlobalKey<FormState>();
  TextEditingController tipoAlerta = new TextEditingController();
  String radioItem = '';
  MapType mapType = MapType.normal;
  BitmapDescriptor icon;
  GoogleMapController controller;
  lc.Location location;
  bool myLocationEnabled = false;
  bool myLocationButtonEnabled = false;

  List alert;
  var alias;
  double latit = 19.9267662;
  double longit = -99.3454187;

  @override
  void initState() {
    mostrarAlias();
    // ubicacionGuardada();
    getIcons();
    // requestPerms();
  }

// Future<String> ubicacionGuardada() async{
// final response = await http.post("http://locateme.codewaymx.com/ubicacionGuardada.php", body: {
//     'correo': '$finalEmail',
//   });
//   var datauser = json.decode(response.body);
//   setState(() {
//      latit = double.parse(datauser[0]);
//     longit = double.parse(datauser[1]);
//     // lalo = ('$latit,$longit');
//     print(latit);
//     print(longit);
//   });
// }

  Future<dynamic> mostrarAlias() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/mostrarAlias.php", body: {
      "correo": '$finalEmail',
    });
    var datauser = json.decode(response.body);
    alias = datauser[0];
    print(finalEmail);
  }

  @override
  Widget build(BuildContext context) {
    var correoShared = finalEmail;
    return Scaffold(
      appBar: AppBar(
        title: Text('Usuario'),
        actions: <Widget>[
          IconButton(
              icon: Icon(Icons.person),
              tooltip: 'Perfil',
              onPressed: () {
                return Navigator.push(context,
                    MaterialPageRoute(builder: (context) => PerfilPage()));
              }), //IconButton
          IconButton(
            icon: Icon(Icons.logout),
            tooltip: 'Cerrar sesión',
            onPressed: () {
              showDialog(
                context: context,
                builder: (BuildContext context) {
                  return AlertDialog(
                    title: Text('¿Quiere cerrar sesión?'),
                    actions: <Widget>[
                      FlatButton(
                        child: Text("Sí"),
                        onPressed: () async {
                          final sharedPreferences =
                              await SharedPreferences.getInstance();
                          sharedPreferences.remove('email');
                          Navigator.push(
                              context,
                              MaterialPageRoute(
                                  builder: (context) => LoginPage()));
                        },
                      ),
                      FlatButton(
                        child: Text("No"),
                        onPressed: () {
                          Navigator.of(context).pop();
                        },
                      ),
                    ],
                  );
                },
              );
            },
          ),
        ],
        backgroundColor: Color.fromRGBO(0, 74, 173, 1.0),
        elevation: 70.0,
        leading: Image(
          image: AssetImage('assets/logoMod.png'),
        ), //IconButton
        brightness: Brightness.dark,
      ), //AppBar
      body: SingleChildScrollView(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Container(
                color: Colors.white,
                width: displayWidth(context),
                height: displayHeight(context) * 0.33,
                child: Column(children: <Widget>[
                  //_crearFondo(context),
                  _loginForm(context),
                ])),
            Container(
              color: Colors.blue,
              width: displayWidth(context),
              height: displayHeight(context) * 0.53,
              child: GoogleMap(
                  // margin: EdgeInsets.symmetric(vertical: 10.0),
                  //  padding: EdgeInsets.symmetric(vertical:30.0),
                  // padding: EdgeInsets.all(20.0),
                  initialCameraPosition: CameraPosition(
                    target: LatLng(latit, longit),
                    zoom: 15,
                  ),
                  myLocationEnabled: myLocationEnabled,
                  myLocationButtonEnabled: myLocationButtonEnabled,
                  mapType: mapType,
                  markers: {
                    Marker(
                      markerId: MarkerId("1"),
                      position: LatLng(latit, longit),
                      icon: icon,
                    ) // markers: makers,
                  }),
            ),
            Container(
              color: Colors.white,
              width: displayWidth(context) * 0.5,
              height: displayHeight(context) * 0.04,
              child: Text(
                '($latit,$longit)',
                style: TextStyle(
                  fontSize: 14,
                  foreground: Paint()
                    ..style = PaintingStyle.stroke
                    ..strokeWidth = 1.5
                    ..color = Colors.orange,
                ),
              ),
            ),
          ],
        ),
      ),
    );

    debugShowCheckedModeBanner:
    false;
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
                      // height: 180.0,
                      ),
                ),
                Container(
                  width: size.width * 1,
                  margin: EdgeInsets.symmetric(vertical: 20.0),
                  padding: EdgeInsets.symmetric(vertical: 10.0),
                  decoration: BoxDecoration(
                    color: Colors.white,
                  ),
                  child: Column(
                    children: <Widget>[
                      Text(
                        'Bienvenido $alias',
                        style: TextStyle(
                          fontSize: 30,
                          foreground: Paint()
                            ..style = PaintingStyle.stroke
                            ..strokeWidth = 3
                            ..color = Colors.blue[700],
                        ),
                      ),
                      SizedBox(height: 20.0),
                      //  _ComboAlerta(),
                      SizedBox(height: 20.0),
                      _botonEnviarA(context),
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

  Widget _tipoAlerta() {
    return Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: <Widget>[
          Container(
            child: Text(
              "Tipo de alerta: ",
              style: TextStyle(color: Colors.black, fontSize: 20),
            ),
          ),
          Container(
            decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(10), color: Colors.green),
            child: Text(
              "",
              style: TextStyle(color: Colors.white, fontSize: 25),
            ),
          ),
        ]);
  }

  Widget _botonEnviarA(BuildContext context) {
    return RaisedButton(
      padding: EdgeInsets.symmetric(horizontal: 20.0, vertical: 15.0),
      splashColor: Colors.grey,

      child: Row(
        mainAxisSize: MainAxisSize.min,
        // mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: <Widget>[
          Icon(
            Icons.send_to_mobile,
            color: Colors.white,
          ),
          Text(
            'Enviar alerta',
            style: TextStyle(
              fontSize: 20,
              fontWeight: FontWeight.w700,
              color: Colors.white,
            ),
          ),
        ],
      ),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(24.0)),
      color: Color.fromRGBO(0, 74, 173, 1.0),
      textColor: Colors.white,
      // onPressed: (){
      //   verTokenUs();
      // }
      onPressed: () {},
    );
  }

// getLocation() async {
//   var currentLocation=await location.getLocation();
//   updateLocation(currentLocation);
// }

// updateLocation(currentLocation) {
//   if (currentLocation!=null) {
//     lat = '${currentLocation.latitude}';
//     long =  '${currentLocation.longitude}';
//   }
//   }

// LocationChange(){
//   location.onLocationChanged.listen((lc.LocationData cLoc){
// if (cLoc!=null)
//   updateLocation(cLoc);
//   });
// }

// requestPerms()async{
//    Map<Permission, PermissionStatus>statuses=
//    await [Permission.locationAlways].request();

//   var status=statuses[Permission.locationAlways];
//   if(status==PermissionStatus.denied){
//     requestPerms();
//   }else{
//     enableGPS();
//   }
//   }

  //  enableGPS()async {
  //   location=lc.Location();
  // bool serviceStatusResult = await location.requestService();
  // if(!serviceStatusResult){
  //   enableGPS();
  // }else{
  //   // UpdateStatus();
  //   // getLocation();
  //   // LocationChange();
  // }
  // }

//  UpdateStatus(){
//     setState(() {
//       myLocationButtonEnabled=true;
//       myLocationEnabled=true;
//     });
//   }

  getIcons() async {
    var icon = await BitmapDescriptor.fromAssetImage(
        ImageConfiguration(devicePixelRatio: 2.5), 'assets/casa.png');
    setState(() {
      this.icon = icon;
    });
  }

  //  onDragEnd(LatLng position){
  //     print('new position $currentLocation');
  //   }
}
