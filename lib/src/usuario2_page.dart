import 'dart:convert';
import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/services.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:overlay_support/overlay_support.dart';
import 'package:prueba/notification_badge.dart';
import 'package:prueba/push_notification.dart';
import 'package:prueba/src/Splashscreen.dart';
import 'package:prueba/src/emisionAlerta.dart';
import 'package:prueba/src/login_page.dart';
import 'package:prueba/src/perfil_pageU2.dart';
import 'package:location/location.dart' as lc;
import 'package:permission_handler/permission_handler.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:prueba/src/sizes_helpers.dart';

class Usuario2Page extends StatefulWidget {
  @override
  _registrarPageState createState() => new _registrarPageState();
}

const default_location = LatLng(19.926738, -99.345431);

class _registrarPageState extends State<Usuario2Page> {
  FirebaseMessaging _messaging = FirebaseMessaging();

  PushNotification _notificationInfo;

  int _totalNotifications;

  final _formKey = GlobalKey<FormState>();
  TextEditingController tipoAlerta = new TextEditingController();

  MapType mapType = MapType.normal;
  BitmapDescriptor icon;
  lc.Location location;
  LatLng currentLocation = default_location;
  bool myLocationEnabled = false;
  bool myLocationButtonEnabled = false;
  Set<Marker> makers = Set<Marker>();
  List alert;
  var alias;
  String lat = '';
  String long = '';
  double latit;
  double longit;
  var selectedTyped;
  List statesList;
  String _myState;
  String _dropdownError;
  String tok;
  String a;
  var rol;

  @override
  void initState() {
    mostrarAlias();
    _getStateList();
    getIcons();
    requestPerms();
    _totalNotifications = 0;
    registerNotification();
    verTokenUs();
  }

  void _validateForm() {
    bool _isValid = _formKey.currentState.validate();

    if (_myState == null) {
      setState(() => _dropdownError = 'Requerido');
      _isValid = false;
    } else {
      emitirAlerta();
      print(_myState);
    }
  }

  Future<String> alertaMsg() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/alertaMsg.php", body: {
      'alerta': _myState,
    });
    var datauser = json.decode(response.body);
    setState(() {
      a = datauser.toString();
      print(a);
      // verTokenCol();
    });
  }

  Future<String> verTokenUs() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/verTokenUs.php", body: {
      'email': '$finalEmail',
    });
    var datauser = json.decode(response.body);
    setState(() {
      tok = datauser.toString();
      print(tok);
      print('Este es el de ver token de usuario $tok');
      // verTokenCol();
    });
  }

  Future<String> verTokenCol() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/verTokenCol.php", body: {
      'email': '$finalEmail',
    });
    var datauser = json.decode(response.body);
    setState(() {
      // tok=datauser;
      for (int i = 0; i < datauser.length; i++) {
        if (datauser[i] == '$tok') {
          print('********* USUARIO ******');
          print(tok);
          print(datauser[i]);
          PushAlert(datauser[i]);
        } else {
          print('********** OTRO *******');
          print(tok);
          print(datauser[i]);
          PushAlert1(datauser[i]);
        }
      }
    });
  }

  void PushAlert(String token) {
    print('***** **************** $token');
    http.post('https://fcm.googleapis.com/fcm/send',
        headers: <String, String>{
          'Content-Type': 'application/json',
          'Authorization':
              'key=AAAA5h5Rb58:APA91bHSAO5-I3Pxd-XdJ0pWrgJOAqO4kEZSlgrSRV9vTuWAQ4j6T-wpcUJGwNIPglTy7gt6rTP9UL_W7_S5FMC09Xf5YjNqtxwDAJgHIjzMqrBpP-k2HYxg9sq3D2sGaSTpyNCejD18',
        },
        body: jsonEncode(<dynamic, dynamic>{
          "to": token,
          "notification": <String, dynamic>{
            "body": "Se envio una alerta de $a ",
            "title": "ALERTA"
          }
        }));
  }

  void PushAlert1(String token) {
    print('***** **************** $token');
    http.post('https://fcm.googleapis.com/fcm/send',
        headers: <String, String>{
          'Content-Type': 'application/json',
          'Authorization':
              'key=AAAA5h5Rb58:APA91bHSAO5-I3Pxd-XdJ0pWrgJOAqO4kEZSlgrSRV9vTuWAQ4j6T-wpcUJGwNIPglTy7gt6rTP9UL_W7_S5FMC09Xf5YjNqtxwDAJgHIjzMqrBpP-k2HYxg9sq3D2sGaSTpyNCejD18',
        },
        body: jsonEncode(<dynamic, dynamic>{
          "to": token,
          "notification": <String, dynamic>{
            "body":
                "Nueva alerta recibida del usuario $alias \n Asunto: $a Coordenadas: ($lat , $long)",
            "title": "ALERTA USUARIO"
          }
        }));
  }

  Future<String> verRoles() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/pantalla.php", body: {
      'email': finalEmail,
    });
    var datauser = json.decode(response.body);
    print(datauser);
    rol = datauser;
  }

  void _navigateToPush() {
    if (rol[0]['idroles'] == '2') {
      Navigator.push(
          context, MaterialPageRoute(builder: (context) => EmisionAlerta()));
    } else {
      showDialog(
          context: context,
          builder: (BuildContext context) {
            return AlertDialog(
              title: Text('No tienes permisos para ver las alertas emitidas'),
              actions: <Widget>[
                TextButton(
                  child: Text("Ok"),
                  onPressed: () {
                    Navigator.of(context).pop();
                    // Navigator.push(context,MaterialPageRoute(builder: (context) => LoginPage()));
                  },
                ),
              ],
            );
          });
    }
  }

// void _navigateToItemDetail(Map<String, dynamic> message) {
//     final Item item = _itemForMessage(message);
//     // Clear away dialogs
//     Navigator.popUntil(context, (Route<dynamic> route) => emitirAlerta()());
//     if (!item.route.isCurrent) {
//       Navigator.push(context, item.route);
//     }
//   }

  void registerNotification() async {
    PushNotification _notificationInfo;
    // 1. Initialize the Firebase app
    await Firebase.initializeApp();

    print("Configure------------------------------");
Future.delayed(Duration(seconds: 1), () {
    _messaging.configure(
        onMessage: (message) async {
          print('onMessage received: $message');

          // Parse the message received
          PushNotification notification = PushNotification.fromJson(message);

          setState(() {
            _notificationInfo = notification;
            _totalNotifications++;
            // _navigateToPush();
          });

          print("------Show Notification");
          showSimpleNotification(
            Text(_notificationInfo.title),
            leading: NotificationBadge(totalNotifications: _totalNotifications),
            subtitle: Text(_notificationInfo.body),
            background: Colors.blue,
            duration: Duration(seconds: 4),
          );
        },
        onBackgroundMessage: _firebaseMessagingBackgroundHandler,
        onLaunch: (message) async {
          print('onLaunch: $message');
          print("Creando el objeto push");
          PushNotification notification = PushNotification.fromJson(message);

          setState(() {
            print("Actualizando el estado");
            _notificationInfo = notification;
            _totalNotifications++;
            _navigateToPush();
          });
        },

        //     onLaunch: (Map<String, dynamic> message) async {
        //   print("onLaunch: $message");
        //   _navigateToItemDetail(message);
        // },

        onResume: (message) async {
          print('onResume: $message');

          PushNotification notification = PushNotification.fromJson(message);

          setState(() {
            _notificationInfo = notification;
            _totalNotifications++;
            _navigateToPush();
          });
        }

        //    onResume: (Map<String, dynamic> message) async {
        //   print("onResume: $message");
        //   _navigateToItemDetail(message);
        // },

        );
  }
   );
    }



  Future<dynamic> _firebaseMessagingBackgroundHandler(
    Map<String, dynamic> message,
  ) async {
    // Initialize the Firebase app
    await Firebase.initializeApp();
    print('onBackgroundMessage received: $message');
  }

  void emitirAlerta() {
    http.post("http://192.168.1.71:80/locateme_back/emitirAlerta.php", body: {
      'correo': '$finalEmail',
      'alerta': '$_myState',
      'latitud': '$lat',
      'longitud': '$long',
    });
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: const Text('Se envío la alerta correctamente'),
      ),
    );
    verTokenCol();
  }

  Future<String> _getStateList() async {
    final response = await http.post(
        "http://192.168.1.71:80/locateme_back/mostrarAlertas.php",
        body: {});
    var datauser = json.decode(response.body);
    setState(() {
      statesList = datauser;
    });
  }

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
        title: Text('Líder'),
        actions: <Widget>[
          IconButton(
              icon: Icon(Icons.backup_table_outlined),
              tooltip: 'Usuarios',
              onPressed: () {
                return Navigator.push(context,
                    MaterialPageRoute(builder: (context) => EmisionAlerta()));
              }),
          IconButton(
              icon: Icon(Icons.person),
              tooltip: 'Perfil',
              onPressed: () {
                return Navigator.push(context,
                    MaterialPageRoute(builder: (context) => PerfilPageU2()));
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
                          // finalEmail=null;
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
                  _loginForm(context),
                ])),
            Container(
              color: Colors.blue,
              width: displayWidth(context),
              height: displayHeight(context) * 0.53,
              child: GoogleMap(
                  initialCameraPosition: CameraPosition(
                    target: LatLng(finalLatit, finalLong),
                    zoom: 15,
                  ),
                  myLocationEnabled: myLocationEnabled,
                  myLocationButtonEnabled: myLocationButtonEnabled,
                  mapType: mapType,
                  markers: {
                    Marker(
                      markerId: MarkerId("1"),
                      position: LatLng(finalLatit, finalLong),
                      icon: icon,
                    ),
                  }),
            ),
            Container(
              color: Colors.white,
              width: displayWidth(context) * 0.5,
              height: displayHeight(context) * 0.04,
              child: Text(
                '($finalLatit,$finalLong)',
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
                  child: Container(// height: 180.0,
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
                      _ComboAlerta(),
                      SizedBox(height: 20.0),
                      _botonEnviarA(context),
                      //  _boton(context),
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

  Widget _ComboAlerta() {
    return Row(
      mainAxisSize: MainAxisSize.min,
      children: <Widget>[
        Icon(Icons.add_alert, color: Colors.blueAccent),
        SizedBox(
          width: 0.0,
          height: 20,
        ),
        DropdownButtonHideUnderline(
          child: ButtonTheme(
            alignedDropdown: true,
            child: DropdownButton<String>(
              value: _myState,
              iconSize: 30,
              icon: (null),
              style: TextStyle(
                color: Colors.black54,
                fontSize: 16,
              ),
              hint: Text('Seleccionar tipo de alerta'),
              onChanged: (String newValue) {
                setState(() {
                  _myState = newValue;
                  _dropdownError = null;
                  print(_myState);
                  alertaMsg();
                });
              },
              items: statesList?.map((item) {
                    return new DropdownMenuItem(
                      child: Text(item['tipoaler_descripcion']),
                      value: item['idtipo_alerta'].toString(),
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
    );
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
      onPressed: () => _validateForm(),
    );
  }

  Widget _boton(BuildContext context) {
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
              'Enviar notificacion',
              style: TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.w700,
                color: Colors.white,
              ),
            ),
          ],
        ),
        shape:
            RoundedRectangleBorder(borderRadius: BorderRadius.circular(24.0)),
        color: Color.fromRGBO(0, 74, 173, 1.0),
        textColor: Colors.white,
        onPressed: () {
          // return Navigator.push(context,
          //     MaterialPageRoute(
          //       builder: (context) => MandarPush()),);
          //  PushAlert();
          verTokenCol();
        });
  }

  getLocation() async {
    var currentLocation = await location.getLocation();
    updateLocation(currentLocation);
  }

// updateLocation(currentLocation) async {
//   if (currentLocation!=null) {
//     print("Ubicacion actual ${currentLocation.latitude} ${currentLocation.longitude}");
//     lat = '${currentLocation.latitude}';
//     long =  '${currentLocation.longitude}';
//   }
//   }

  updateLocation(currentLocation) {
    if (currentLocation != null) {
      print(
          "Ubicacion actual ${currentLocation.latitude} ${currentLocation.longitude}");
      setState(() {
        lat = '${currentLocation.latitude}';
        long = '${currentLocation.longitude}';
//       this.currentLocation=LatLng(currentLocation.latitude,currentLocation.longitude);
//       this.controller.animateCamera(CameraUpdate.newCameraPosition(
//         CameraPosition(target:this.currentLocation, zoom: 11)
//       ));
// createMarkers();
      });
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

  getIcons() async {
    var icon = await BitmapDescriptor.fromAssetImage(
        ImageConfiguration(size: Size(75, 75)), 'assets/marcadorChido.png');
    setState(() {
      this.icon = icon;
    });
  }

  onDragEnd(LatLng position) {
    print('new position $currentLocation');
  }
}
