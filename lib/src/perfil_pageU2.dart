import 'dart:convert';
import 'package:prueba/src/Splashscreen.dart';
import 'package:prueba/src/editarPerfilU2.dart';
import 'package:prueba/src/usuario2_page.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';

class PerfilPageU2 extends StatefulWidget {
  @override
  _PerfilPageState createState() => _PerfilPageState();
}

class _PerfilPageState extends State<PerfilPageU2> {
  final _formKey = GlobalKey<FormState>();

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

  int iduser = 1;
  var nomb;
  var ape;
  var ap2;
  var fecha;
  var telef, call, nume, us;

  Future<dynamic> verDatos() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/mostrarDatos.php", body: {
      "correo": correo.text,
    });
    var datauser = json.decode(response.body);

    nomb = datauser[0];
    ape = datauser[1];
    ap2 = datauser[2];
    fecha = datauser[3];
    telef = datauser[4];
    call = datauser[5];
    nume = datauser[6];
    us = datauser[7];

    nombre.text = '$nomb';
    ape1.text = '$ape';
    ape2.text = '$ap2';
    fechaN.text = '$fecha';
    tel.text = '$telef';
    calle.text = '$call';
    numero.text = '$nume';
    user.text = '$us';
  }

  @override
  initState() {
    correo.text = "$finalEmail";
    verDatos();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Perfil"),
        actions: <Widget>[
          IconButton(
              iconSize: 40,
              icon: Icon(Icons.edit_rounded),
              tooltip: 'Editar datos',
              onPressed: () {
                Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => EditarPerfilPageU2()));
              }),
        ], //<Widget>[]
        backgroundColor: Color.fromRGBO(0, 74, 173, 1.0),
        elevation: 70.0,

        leading: Image(
          image: AssetImage('assets/logoMod.png'),
        ), //IconButton
        brightness: Brightness.dark,
      ),
      body: Stack(
        key: _formKey,
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
                        'Perfil',
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
                      _fechaNac(),
                      _telefono(),
                      _calle(),
                      _numero(),
                      _correo(),
                      _usuario(),
                      SizedBox(height: 20.0),
                      _botonRegresar(context),
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
        enabled: false,
        keyboardType: TextInputType.name,
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
        enabled: false,
        keyboardType: TextInputType.text,
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
        enabled: false,
        keyboardType: TextInputType.text,
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
        enabled: false,
        keyboardType: TextInputType.datetime,
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

  Widget _telefono() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        enabled: false,
        keyboardType: TextInputType.number,
        controller: tel,
        validator: (value) {
          if (value.isEmpty) {
            return 'El número de teléfono es requerido';
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
        enabled: false,
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
    );
  }

  Widget _numero() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        enabled: false,
        keyboardType: TextInputType.text,
        controller: numero,
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

  Widget _codigoP() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        enabled: false,
        keyboardType: TextInputType.number,
        controller: codigoP,
        validator: (value) {
          if (value.isEmpty) {
            return 'El código postal es requerido';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.streetview_outlined, color: Colors.blueAccent),
          // hintText: 'ejemplo@correo.com',
          labelText: 'Código postal',
        ),
      ),
    );
  }

  Widget _colonia() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        enabled: false,
        keyboardType: TextInputType.text,
        controller: colonia,
        validator: (value) {
          if (value.isEmpty) {
            return 'El nombre de la colonia es requerido';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.house_outlined, color: Colors.blueAccent),
          // hintText: 'ejemplo@correo.com',
          labelText: 'Colonia',
        ),
      ),
    );
  }

  Widget _municipio() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        enabled: false,
        keyboardType: TextInputType.text,
        controller: municipio,
        validator: (value) {
          if (value.isEmpty) {
            return 'El nombre del municipio es requerido';
          }
        },
        decoration: InputDecoration(
          icon: Icon(Icons.house_sharp, color: Colors.blueAccent),
          // hintText: 'ejemplo@correo.com',
          labelText: 'Municipio',
        ),
      ),
    );
  }

  Widget _correo() {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 20.0),
      child: TextFormField(
        enabled: false,
        keyboardType: TextInputType.emailAddress,
        controller: correo,
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
        enabled: false,
        keyboardType: TextInputType.text,
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

  Widget _botonRegresar(BuildContext context) {
    return RaisedButton(
      padding: EdgeInsets.symmetric(horizontal: 50.0, vertical: 15.0),
      splashColor: Colors.grey,
      child: Row(
        mainAxisSize: MainAxisSize.min,
        // mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: <Widget>[
          Icon(
            Icons.arrow_back_rounded,
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
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(6.0)),
      color: Color.fromRGBO(0, 74, 173, 1.0),
      textColor: Colors.white,
      onPressed: () {
        // verDatos();
        return Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => Usuario2Page(),
            ));
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
}