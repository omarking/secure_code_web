import 'dart:async';
import 'dart:convert';
import 'package:email_validator/email_validator.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:prueba/src/Splashscreen.dart';
import 'package:prueba/src/login_page.dart';
import 'package:prueba/src/ubicacion_page.dart';
import 'package:shared_preferences/shared_preferences.dart';

String correo = '';

class RecuperarPass extends StatefulWidget {
  @override
  _RecuperarPageState createState() => new _RecuperarPageState();
}

class _RecuperarPageState extends State<RecuperarPass> {
  final _formKey = GlobalKey<FormState>();

  TextEditingController user = new TextEditingController();
  bool isvalid = false;
  String msg = '';

  Future<List> recuperar() async {
    final response = await http
        .post('http://192.168.1.71:80/locateme_back/emailRecup.php', body: {
      "correo": user.text,
    });
    var datauser = json.decode(response.body);
    print(datauser);
    if (datauser[0] == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: const Text('El correo no existe, Intenta con otro'),
        ),
      );
      user.text = '';
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content:
              const Text('El correo de recuperación se envió exitosamente'),
        ),
      );
      user.text = '';
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
                      'Recuperar tu contraseña',
                      style: TextStyle(
                        fontSize: 18,
                        foreground: Paint()
                          ..style = PaintingStyle.stroke
                          ..strokeWidth = 3
                          ..color = Colors.blue[700],
                      ),
                    ),
                    SizedBox(height: 20.0),
                    _correoE(),
                    SizedBox(height: 20.0),
                    //  _contrasenia(),
                    SizedBox(height: 30.0),
                    _botonDoble(context),
                  ],
                ),
              ),
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
        validator: (value) {
          if (value.isEmpty) {
            return 'El correo electrónico es requerido';
          }
        },
        decoration: inputDecoration,
      ),
    );
  }

  Widget _botonGuardar(BuildContext context) {
    return ElevatedButton(
      onPressed: () {
        if (_formKey.currentState.validate()) {
          isvalid = EmailValidator.validate(user.text);
          if (isvalid) {
            recuperar();
          } else {
            ScaffoldMessenger.of(context).showSnackBar(
              SnackBar(
                content: const Text('El correo es inválido'),
              ),
            );
            user.text = '';
          }
        }
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

  Widget _botonDoble(BuildContext context) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
      children: <Widget>[
        RaisedButton(
          padding: EdgeInsets.symmetric(horizontal: 10.0, vertical: 15.0),
          splashColor: Colors.grey,
          child: Row(
            mainAxisSize: MainAxisSize.min,
            // mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: <Widget>[
              Icon(
                Icons.recent_actors_outlined,
                color: Colors.white,
              ),
              Text(
                'Recuperar',
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
              isvalid = EmailValidator.validate(user.text);
              if (isvalid) {
                recuperar();
              } else {
                ScaffoldMessenger.of(context).showSnackBar(
                  SnackBar(
                    content: const Text('El correo es inválido'),
                  ),
                );
                user.text = '';
              }
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
                Icons.reply_all_sharp,
                color: Colors.white,
              ),
              Text(
                'Regresar',
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
                context, MaterialPageRoute(builder: (context) => LoginPage())
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
