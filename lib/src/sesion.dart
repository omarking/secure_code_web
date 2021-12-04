import 'dart:async';
import 'package:flutter/material.dart';
import 'package:prueba/src/Splashscreen.dart';
import 'package:prueba/src/login_page.dart';
import 'package:shared_preferences/shared_preferences.dart';

String finalEmail;

class Sesion extends StatefulWidget {
  @override
  _SplashScreenState createState() => _SplashScreenState();
}

class _SplashScreenState extends State<Sesion>{
 


   @override
   void initState() { 
     print('Este el lo primero de la sesion ************ $finalEmail');
     getValidationData().whenComplete(() async{
        Timer(Duration(seconds: 1), () => Navigator.push(context,MaterialPageRoute(
               builder: (context) => finalEmail == null ? LoginPage() : SplashScreen())));
     });
     super.initState();
   }

   Future getValidationData() async{
     final SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    var obtenerEmail = sharedPreferences.getString('email');
   setState(() {
     finalEmail = obtenerEmail;
   });
   print(finalEmail);
   }

 @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Padding(
              padding: const EdgeInsets.only(top: 9.0),
            )
          ],
        ),
      ),
    );
  }
}