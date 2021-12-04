import 'dart:async';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:prueba/src/Splashscreen.dart';
import 'package:prueba/src/usuario1_page.dart';
import 'package:prueba/src/usuario2_page.dart';

String correo = '';

class RolesUser extends StatefulWidget {
  @override
  _LoginPageState createState() => new _LoginPageState();
}

class _LoginPageState extends State<RolesUser> {
  final _formKey = GlobalKey<FormState>();
  List statesList;
  String _myState;
  String _dropdownError;

  String msg = '';

  @override
  void initState() {
    _getStateList();
  }

  Future<String> _getStateList() async {
    final response = await http.post(
        "http://192.168.1.71:80/locateme_back/mostrarRoles.php",
        body: {});
    var datauser = json.decode(response.body);
    setState(() {
      statesList = datauser;
    });
  }

  Future<String> Roles() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/registrarRoles.php", body: {
      'rol': _myState,
      'email': finalEmail,
    });
    if (_myState == 1) {
      Navigator.push(
          context, MaterialPageRoute(builder: (context) => Usuario1Page()));
    } else {
      Navigator.push(
          context, MaterialPageRoute(builder: (context) => Usuario2Page()));
    }
  }

  void _validateForm() {
    bool _isValid = _formKey.currentState.validate();

    if (_myState == null) {
      setState(() => _dropdownError = 'Requerido');
      _isValid = false;
    } else {
      Roles();
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
                        'Tipo de usuario',
                        style: TextStyle(
                          fontSize: 25,
                          foreground: Paint()
                            ..style = PaintingStyle.stroke
                            ..strokeWidth = 3
                            ..color = Colors.blue[700],
                        ),
                      ),
                      SizedBox(height: 20.0),
                      _comboRoles(),
                      SizedBox(height: 20.0),
                      _botonDoble(context),
                    ],
                  ),
                ),
              ],
            ),
          )
        ],
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
                'Guardar',
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
          onPressed: () => _validateForm(),
        ),
      ],
    );
  }

  Widget _comboRoles() {
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
              hint: Text('Seleccionar tipo de usuario'),
              onChanged: (String newValue) {
                setState(() {
                  _myState = newValue;
                  _dropdownError = null;
                  print(_myState);
                });
              },
              items: statesList?.map((item) {
                    return new DropdownMenuItem(
                      child: Text(item['rol_descripcion']),
                      value: item['idroles'].toString(),
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
        ),
      ],
    );
  }
}
