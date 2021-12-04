import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:prueba/obtener_token.dart';
import 'package:prueba/src/login_page.dart';
import 'package:prueba/src/sesion.dart';
import 'package:prueba/src/usuario1_page.dart';
import 'package:prueba/src/usuario2_page.dart';
import 'package:shared_preferences/shared_preferences.dart';

String finalEmail;
double finalLatit;
double finalLong;

class SplashScreen extends StatefulWidget {
  @override
  _SplashScreenState createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  String rol;

  @override
  void initState() {
    // ubicacionGuardada();
    print('Este el lo primero del splash ************ $finalEmail');
    //  if(getValidationData().whenComplete() == true){
    //    Timer(Duration(seconds: 2), () => verRoles());
    //  } else{
    //    ScaffoldMessenger.of(context).showSnackBar(
    //                   SnackBar(
    //                     content: const Text('Error de servidor'),
    //                   ),
    //                 );
    //   Navigator.push(context,MaterialPageRoute(builder: (context) => LoginPage()));
    //  }
    //  initialRoute: finalEmail == '' ? 'login' : 'splash',
    getValidationData().whenComplete(() async {
      Timer(Duration(seconds: 2),
          () => finalEmail == null ? LoginPage() : verRoles());
    });
    llamarUbicacion();
    super.initState();
    final pushProvider = new PushN();
    pushProvider.initNotifications();
  }

  Future getValidationData() async {
    final SharedPreferences sharedPreferences =
        await SharedPreferences.getInstance();
    var obtenerEmail = sharedPreferences.getString('email');
    setState(() {
      finalEmail = obtenerEmail;
    });
    print(finalEmail);
  }

  Future llamarUbicacion() async {
    final SharedPreferences sharedPreferences =
        await SharedPreferences.getInstance();
    var obtenerLat = sharedPreferences.getDouble('latit');
    var obtenerLong = sharedPreferences.getDouble('longit');
    setState(() {
      finalLatit = obtenerLat;
      finalLong = obtenerLong;
    });
    print(finalEmail);
    print(finalLatit);
    print(finalLong);
  }
  //  getValidationData1() async{
  //    final SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
  //   var obtenerLat = sharedPreferences.getString('$latit');
  //   var obtenerLong = sharedPreferences.getString('$longit');
  //  setState(() {
  //    finalLat = double.parse(obtenerLat);
  //    finalLong = double.parse(obtenerLong);
  //  });
  //  print('finalLat************************ $finalLat');
  //   print(finalLong);
  //  }

// Future<Builder> ubicacionGuardada() async{
// final response = await http.post("http://locateme.codewaymx.com/ubicacionGuardada.php",body: {
//     'correo': '$finalEmail',
//   });
//   var datauser = json.decode(response.body);
//   setState(() {
//      latit = double.parse(datauser[0]);
//     longit = double.parse(datauser[1]);
//     getValidationData1();
//     print('***************************************************  splash $latit');
//     print(longit);
//   });
// }

  Future<String> verRoles() async {
    final response = await http
        .post("http://192.168.1.71:80/locateme_back/pantalla.php", body: {
      'email': finalEmail,
    });
    var datauser = json.decode(response.body);
    print(datauser);
    // rol = datauser;
    setState(() {
      // if(datauser[0]['nivel']=='super'){
      //    Navigator.pushReplacementNamed(context, '/powerPage');
      // }else if(datauser[0]['nivel']=='bodega'){
      // Navigator.pushReplacementNamed(context, '/usuario1_page');

      if (datauser[0]['idroles'] == '1') {
        Navigator.push(
            context, MaterialPageRoute(builder: (context) => Usuario1Page()));
        // Navigator.push(context,MaterialPageRoute(builder: (context) => finalEmail == null ? LoginPage() : RolesUser()))
      } else if (datauser[0]['idroles'] == '2') {
        Navigator.push(
            context, MaterialPageRoute(builder: (context) => Usuario2Page()));
      } else {
        showDialog(
            context: context,
            builder: (BuildContext context) {
              return AlertDialog(
                title: Text('El correo no está registrado\n     ¡Registrate!'),
                actions: <Widget>[
                  TextButton(
                    child: Text("Ok"),
                    onPressed: () {
                      // Navigator.of(context).pop();
                      Navigator.push(context,
                          MaterialPageRoute(builder: (context) => LoginPage()));
                    },
                  ),
                ],
              );
            });
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            CircleAvatar(
              child: Image(image: AssetImage('assets/logoMod.png')),
              radius: 110.0,
              backgroundColor: Color.fromRGBO(0, 74, 173, 1.0),
            ),
            Padding(
              padding: const EdgeInsets.only(top: 9.0),
              child: CircularProgressIndicator(
                backgroundColor: Color.fromRGBO(0, 74, 173, 1.0),
              ),
            )
          ],
        ),
      ),
    );
  }
}
