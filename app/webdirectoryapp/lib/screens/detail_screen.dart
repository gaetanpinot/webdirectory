import 'package:flutter/material.dart';

class DetailScreen extends StatelessWidget {
  final String name; 
  final String prenom; 
  final String serviceLibelle;

  DetailScreen({
    required this.name,
    required this.prenom,
    required this.serviceLibelle,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Détails'),
      ),
      body: Padding(
        padding: EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              'Nom & prénom :',
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            Text('$name $prenom'),
            SizedBox(height: 16.0),
            Text(
              'Service / département :',
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            Text(serviceLibelle),
          ],
        ),
      ),
    );
  }
}
