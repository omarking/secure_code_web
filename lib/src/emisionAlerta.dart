import 'dart:convert';
import 'package:flutter/services.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:prueba/src/Splashscreen.dart';
import 'package:prueba/src/usuario2_page.dart';
import 'package:location/location.dart' as lc;
import 'package:permission_handler/permission_handler.dart';
import 'package:prueba/src/sizes_helpers.dart';

class EmisionAlerta extends StatefulWidget {
  @override
  _emisionPageState createState() => _emisionPageState();
}

const default_location = LatLng(27.037486, -103.685334);

class _emisionPageState extends State<EmisionAlerta> {
  final _formKey = GlobalKey<FormState>();
  TextEditingController tipoAlerta = new TextEditingController();
  String radioItem = '';
  MapType mapType = MapType.normal;
  BitmapDescriptor icon, icon2;
  GoogleMapController controller;
  lc.Location location;
  bool myLocationEnabled = false;
  bool myLocationButtonEnabled = false;
  LatLng currentLocation = default_location;
  Set<Marker> makers = Set<Marker>();
  List alert;
  var alias;
  String lat = '';
  String long = '';
  double latit;
  double longit;
  double latitEMI;
  double longitEMI;
  String lalo;
  var selectedTyped;
  List statesList;
  String _myState;
  String _dropdownError;
  var selectedTyped1;
  List statesList1;
  String _myState1;
  String _dropdownError1;
  var emi;

  @override
  void initState() {
    _getStateList();
    // dataEmision();
    mostrarAlias();
    getIcons();
    requestPerms();
  }

  void _validateForm() {
    bool _isValid = _formKey.currentState.validate();

    if (_myState == null) {
      setState(() => _dropdownError = 'Requerido');
      _isValid = false;
    } else {
      _validateForm1();
    }
  }

  void _validateForm1() {
    bool _isValid1 = _formKey.currentState.validate();

    if (_myState1 == null) {
      setState(() => _dropdownError1 = '*');
      _isValid1 = false;
    } else if (radioItem.isEmpty) {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: Text('Debes elegir el tipo de atencion'),
            actions: <Widget>[
              FlatButton(
                child: Text('OK'),
                onPressed: () {
                  Navigator.of(context).pop();
                  //  Navigator.push(context,MaterialPageRoute(builder: (context) => EmisionAlerta()));
                },
              ),
            ],
          );
        },
      );
    } else {
      atencionA();
      // emitirAlerta();
      print(_myState1);
      print('$radioItem');
    }
  }

  Future<String> ubicacionGuardada1() async {
    final response = await http.post(
        "http://192.168.1.71:80/locateme_back/ubicacionGuardada.php",
        body: {
          'correo': '$_myState1',
        });
    var datauser = json.decode(response.body);
    setState(() {
      latitEMI = double.parse(datauser[0]);
      longitEMI = double.parse(datauser[1]);
    });
    Marker(
      visible: true,
      markerId: MarkerId("2"),
      position: LatLng(latitEMI, longitEMI),
      icon: icon2,
    );
  }

  Future<String> atencionA() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/atencionAlerta.php", body: {
      'emision': '$_myState1',
      'entidad': '1',
      'observacion': '$radioItem',
    });

    // setState(() {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Se guardo el tipo de atencion'),
          actions: <Widget>[
            FlatButton(
              child: Text('OK'),
              onPressed: () {
                Navigator.push(context,
                    MaterialPageRoute(builder: (context) => EmisionAlerta()));
              },
            ),
          ],
        );
      },
    );
    //  print('guardado');
    // });
  }

  Future<String> _getStateList() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/usuarios.php", body: {
      'email': '$finalEmail',
    });
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

  Future<dynamic> dataEmision() async {
    final response = await http.post(
        "http://192.168.1.71:80/locateme_back/DataGridEmision.php",
        body: {
          'correo': _myState,
        });
    var datauser = json.decode(response.body);
    setState(() {
      statesList1 = datauser;
    });
    print('Entro al data');
    print(datauser);
    print(_myState);
  }

  @override
  Widget build(BuildContext context) {
    var correoShared = finalEmail;
    return Scaffold(
      appBar: AppBar(
        title: Text('Líder'),
        actions: <Widget>[
          IconButton(
              icon: Icon(Icons.cancel_presentation_rounded),
              tooltip: 'Salir',
              onPressed: () {
                return Navigator.push(context,
                    MaterialPageRoute(builder: (context) => Usuario2Page()));
              }), //IconButton
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
              height: displayHeight(context) * 0.28,
              child: Column(
                children: <Widget>[
                  SingleChildScrollView(
                    child: Column(children: <Widget>[
                      //_crearFondo(context),
                      _loginForm(context),
                    ]),
                  )
                ],
              ),
            ),
            Container(
              color: Colors.blue,
              width: displayWidth(context),
              height: displayHeight(context) * 0.53,
              child: GoogleMap(
                  // margin: EdgeInsets.symmetric(vertical: 10.0),
                  //  padding: EdgeInsets.symmetric(vertical:30.0),
                  // padding: EdgeInsets.all(20.0),
                  initialCameraPosition: CameraPosition(
                    target: LatLng(finalLatit, finalLong),
                    zoom: 15,
                  ),
                  myLocationEnabled: myLocationEnabled,
                  myLocationButtonEnabled: myLocationButtonEnabled,
                  mapType: mapType,
                  markers: {
                    Marker(
                      visible: false,
                      markerId: MarkerId("2"),
                      position: LatLng(finalLatit, finalLong),
                      icon: icon,
                    ), // markers: makers,
                  }),
            ),
            Container(
              child: Column(children: <Widget>[
                radioB(),
                SizedBox(height: 10.0),
                _botonEnviarA(context),
              ]),
              color: Colors.white,
              width: displayWidth(context),
              height: displayHeight(context) * 0.30,
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
                        'Atención de alertas',
                        style: TextStyle(
                          fontSize: 30,
                          foreground: Paint()
                            ..style = PaintingStyle.stroke
                            ..strokeWidth = 3
                            ..color = Colors.blue[700],
                        ),
                      ),
                      SizedBox(height: 20.0),
                      _ComboUsuario(),
                      _ComboAlerta(),
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

  Widget _Usuarios() {
    return Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: <Widget>[
          Container(
            child: Text(
              "Usuario: ",
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

  Widget radioB() {
    return Container(
      padding: EdgeInsets.all(10.0),
      child: new Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          new Text(
            'Selecciona tipo de atención',
            style: new TextStyle(
                color: Color.fromRGBO(0, 74, 173, 1.0),
                fontSize: 20.0,
                fontWeight: FontWeight.bold),
          ),
          // new Padding(
          //   padding: new EdgeInsets.all(8.0),
          // ),
          Divider(height: 5.0, color: Color.fromRGBO(0, 74, 173, 1.0)),

          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Radio(
                  value: 'Solucionado',
                  groupValue: radioItem,
                  onChanged: (val) {
                    setState(() {
                      radioItem = val;
                    });
                  }),
              new Text(
                'Solucionado',
                style: new TextStyle(
                  fontSize: 16.0,
                ),
              ),
              new Radio(
                  value: 'Falsa alarma',
                  groupValue: radioItem,
                  onChanged: (val) {
                    setState(() {
                      radioItem = val;
                    });
                  }),
              new Text(
                'Falsa alarma',
                style: new TextStyle(fontSize: 16.0),
              ),
            ],
          ),

          // Text('$radioItem', style: TextStyle(fontSize: 23),)
        ],
      ),
    );
  }

  Widget _ComboUsuario() {
    return Row(
      mainAxisSize: MainAxisSize.min,
      children: <Widget>[
        Icon(Icons.person, color: Colors.blueAccent),
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
              hint: Text('Selecciona un usuario'),
              onChanged: (String newValue) {
                setState(() {
                  _myState = newValue;
                  _dropdownError = null;
                  print(_myState);
                  dataEmision();
                });
              },
              items: statesList?.map((item) {
                    return new DropdownMenuItem(
                      child: Text(item['nombreC']),
                      value: item['idusuario'].toString(),
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
              value: _myState1,
              iconSize: 30,
              icon: (null),
              style: TextStyle(
                color: Colors.black54,
                fontSize: 10,
              ),
              hint: Text('Selecciona una emision de alerta'),
              onChanged: (String newValue) {
                setState(() {
                  _myState1 = newValue;
                  _dropdownError1 = null;
                  print(_myState1);
                  ubicacionGuardada1();
                });
              },
              items: statesList1?.map((item) {
                    return new DropdownMenuItem(
                      child: Text(item['alertasAC']),
                      value: item['idemision_alerta'].toString(),
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
            Icons.save_outlined,
            color: Colors.white,
          ),
          Text(
            'Guardar',
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

  getLocation() async {
    var currentLocation = await location.getLocation();
    updateLocation(currentLocation);
  }

  updateLocation(currentLocation) {
    if (currentLocation != null) {}
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
      LocationChange();
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
        ImageConfiguration(devicePixelRatio: 2.5), 'assets/casa.png');
    setState(() {
      this.icon = icon;
    });
  }

  getIcons1() async {
    var icon2 = await BitmapDescriptor.fromAssetImage(
        ImageConfiguration(devicePixelRatio: 2.5), 'assets/alertaAlert.png');
    setState(() {
      this.icon = icon2;
    });
  }

  // ignore: always_declare_return_types
  //  onDragEnd(LatLng position){
  //     print('new position $currentLocation');
  //   }

}
