import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:prueba/push_notification.dart';
import 'package:prueba/src/Splashscreen.dart';
import 'package:http/http.dart' as http;

class PushN {
  FirebaseMessaging _messaging = FirebaseMessaging();

  PushNotification _notificationInfo;

  var obt;
  var correo;
  @override
  void initNotifications() {
    registerNotification();
  }

  void guardarToken() {
    http.post("http://192.168.1.71:80/locateme_back/guardarToken.php", body: {
      'email': '$correo',
      'token': '$obt',
    });
    print(obt);
    print(finalEmail);
  }

  @override
  Widget build(BuildContext context) {}

  void registerNotification() async {
    PushNotification _notificationInfo;
    // 1. Initialize the Firebase app
    await Firebase.initializeApp();

    print("Obteniendo el token-----------------------------");
    _messaging.getToken().then((token) {
      print('Token: $token');
      obt = token;
      correo = finalEmail;
      guardarToken();
    }).catchError((e) {
      print(e);
    });
  }
}
