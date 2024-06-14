import 'package:flutter/material.dart';

class WebListApp extends StatefulWidget {
  const WebListApp({super.key});

  @override
  _WebListAppState createState() => _WebListAppState();
}

class _WebListAppState extends State<WebListApp> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Web List'),
      ),
      body: Center(
        child: Text('Web List'),
      ),
    );
  }
}
