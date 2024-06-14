import 'package:flutter/material.dart';

class DetailScreen extends StatelessWidget {
  final String name; // Nom complet de l'utilisateur
  final String prenom; // Prénom de l'utilisateur
  final String
      serviceLibelle; // Libellé du service/departement de l'utilisateur

  const DetailScreen({
    super.key,
    required this.name,
    required this.prenom,
    required this.serviceLibelle,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Détails'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Nom & prénom :',
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            Text('$name $prenom'), // Afficher le nom complet de l'utilisateur
            const SizedBox(height: 16.0),
            const Text(
              'Service / département :',
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            Text(serviceLibelle), // Afficher le libellé du service/département
          ],
        ),
      ),
    );
  }
}
