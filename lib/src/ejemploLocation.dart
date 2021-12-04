// // import 'package:locateme/src/usuario1_page.dart';
// import 'package:location/location.dart' as lc;
// import 'package:http/http.dart' as http;
// import 'package:flutter/material.dart';
// import 'package:google_maps_flutter/google_maps_flutter.dart';
// import 'package:permission_handler/permission_handler.dart';

// class Location extends StatefulWidget {
//   @override
//   _coordenadas createState() => _coordenadas();
// }

// const default_location=LatLng(27.037486, -103.685334);

// class _coordenadas extends State<Location> {

//   var idusuario = 2;
//   // var lat ='${currentLocation.latitude}';


//   // LatLng default_location=(27.037486 , -103.685334);
//   MapType mapType=MapType.normal;
//   BitmapDescriptor icon;
//   GoogleMapController controller;
//   lc.Location location;
//   bool myLocationEnabled = false;
//   bool myLocationButtonEnabled = false;
//   LatLng currentLocation=default_location;
//   String lat = '';
//   String long = '';
//   Set<Marker>makers=Set<Marker>();
//   // LatLng default_location;


//   void registrar(){
//       http.post("http://locateme.codewaymx.com/ubicacionUser.php", body: {
//     'idusuario': '3',
//     'ubi_latitud': '$lat',
//     'ubi_longitud': '$long',
//     'ubi_fecha': '${DateTime.now()}',
//     //  ${currentLocation.latitude}
//     //  '${currentLocation.longitude}'
//   }); 
//   print("este es la latitud: $lat");
//   print(lat);
//   print(long);
//     // Text('${currentLocation.latitude}');
//     // Navigator.push(context,MaterialPageRoute(builder: (context) => Usuario1Page()));
// }


// @override
// void initState() { 
//   // getIcons();
//   requestPerms();
// }

// // void set defaul_location(LatLng x){
// // default_location = x;
// // }


// getLocation() async {
//   var currentLocation=await location.getLocation();
//   updateLocation(currentLocation);
// }

// updateLocation(currentLocation){
//   if (currentLocation!=null) {
//     print("Ubicacion actual ${currentLocation.latitude} ${currentLocation.longitude}");
//     print(DateTime.now());}
//     lat = '${currentLocation.latitude}';
//     long =  '${currentLocation.longitude}';
    
//   }

// LocationChange(){
//   location.onLocationChanged.listen((lc.LocationData cLoc){
// if (cLoc!=null)
//   updateLocation(cLoc);
//   });
// }

// requestPerms()async{
//    Map<Permission, PermissionStatus>statuses=
//    await [Permission.locationAlways].request();
  
//   var status=statuses[Permission.locationAlways];
//   if(status==PermissionStatus.denied){
//     requestPerms();
//   }else{
//     enableGPS();
//   }
//   }

//   enableGPS()async {
//     location=lc.Location();
//   bool serviceStatusResult = await location.requestService();
//   if(!serviceStatusResult){
//     enableGPS();
//   }else{
//     UpdateStatus();
//     getLocation();
//     // LocationChange();
//   }
//   }

//   UpdateStatus(){
//     setState(() {
//       myLocationButtonEnabled=true;
//       myLocationEnabled=true;
//     });
//   }

//   Widget _botonEnviarA(BuildContext context){
//     return RaisedButton(
//       child: Container(
//         padding: EdgeInsets.symmetric(horizontal:70.0, vertical: 15.0),
//         child: Text('Guardar ubicación'),
//       ),
//       shape: RoundedRectangleBorder(
//         borderRadius: BorderRadius.circular(24)
//       ),
//       color: Color.fromRGBO(0, 74, 173, 1.0),
//       textColor: Colors.white,
//       onPressed: () {
//          registrar();
//       },
//     );
//   }


//   @override
//     Widget build(BuildContext context) {
      
//       return Scaffold(
//         appBar: AppBar(
//           title: Text('widget.title'),
//         ),
//         body: Stack(
//           children: <Widget>[
//              _botonEnviarA(context),
             
//           ],
//         ),// This trailing comma makes auto-formatting nicer for build methods.
//       );
//     }
//     //  onDragEnd(LatLng position){
//     //     print('new position $currentLocation');
//     //   }
//   }
