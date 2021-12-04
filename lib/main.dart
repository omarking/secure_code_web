import 'package:flutter/material.dart';
import 'package:overlay_support/overlay_support.dart';
import 'package:prueba/principal.dart';
import 'package:prueba/src/Splashscreen.dart';
import 'package:prueba/src/ejemploLocation.dart';
import 'package:prueba/src/login_page.dart';
import 'package:prueba/src/sesion.dart';
import 'package:prueba/src/usuario1_page.dart';

void main() => runApp(MyApp());
  
class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return OverlaySupport(
    child: MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Locateme',
      //  initialRoute: finalEmail = null ? 'login' : 'splash',
      initialRoute: 'sesion',
     routes: {
        // 'not' :(BuildContext context) => PushN(),
        'login' :(BuildContext context) => LoginPage(),
        'sesion' :(BuildContext context) => Sesion(),
        // 'registrar' :(BuildContext context) => RegistrarPage(),
        'usuario1':(BuildContext context) => Usuario1Page(),
        'splash':(BuildContext context) => SplashScreen(),
        // 'location':(BuildContext context) => Location(),
      },
      ));
  }
}