import 'dart:convert';

import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:overlay_support/overlay_support.dart';
import 'package:prueba/notification_badge.dart';
import 'package:prueba/push_notification.dart';
import 'package:prueba/src/Splashscreen.dart';
import 'package:prueba/src/emisionAlerta.dart';
import 'package:http/http.dart' as http;

class MandarPush extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return _NotificationScreen();
  }
}

class _NotificationScreen extends State<MandarPush> {
  FirebaseMessaging _messaging = FirebaseMessaging();

  PushNotification _notificationInfo;
  var rol;
  int _totalNotifications;
  var obt;
  @override
  void initState() {
    super.initState();
    _totalNotifications = 0;
    registerNotification();
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

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Storecode'),
        brightness: Brightness.dark,
      ),
    );
  }

  void registerNotification() async {
    PushNotification _notificationInfo;
    // 1. Initialize the Firebase app
    await Firebase.initializeApp();

    print("Configure------------------------------");
    _messaging.configure(
        onMessage: (message) async {
          print(
              'onMessage **********************************************************');
          print('onMessage received: $message');

          // Parse the message received
          PushNotification notification = PushNotification.fromJson(message);

          setState(() {
            _notificationInfo = notification;
            _totalNotifications++;
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
          print(
              'onLaunch **********************************************************');
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
        onResume: (message) async {
          print(
              'onResume **********************************************************');
          print('onResume: $message');

          PushNotification notification = PushNotification.fromJson(message);

          setState(() {
            _notificationInfo = notification;
            _totalNotifications++;
            _navigateToPush();
          });
        });
  }

  Future<dynamic> _firebaseMessagingBackgroundHandler(
    Map<String, dynamic> message,
  ) async {
    // Initialize the Firebase app
    await Firebase.initializeApp();
    print('onBackgroundMessage received: $message');
  }
}
