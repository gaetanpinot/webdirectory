import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:webdirectoryapp/models/fonction.dart';
import 'package:webdirectoryapp/models/personne.dart';

class DetailScreen extends StatelessWidget {
  final Personne? personne;

  const DetailScreen({
    super.key,
    this.personne,
  });

  @override
  Widget build(BuildContext context) {
    List<Fonction> fonctions;
    fonctions = personne!.fonction;
    return Scaffold(
      appBar: AppBar(
        title: const Text('Détails'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Center(
              child: CircleAvatar(
                radius: 50.0,
                backgroundImage: NetworkImage(personne!.imageUrl),
              ),
            ),
            const SizedBox(height: 16.0),
            const Text(
              'Nom & prénom :',
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            Text('${personne!.nom} ${personne!.prenom}'),
            const SizedBox(height: 16.0),
            const Text(
              'Service / département :',
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: personne!.service
                  .map((service) => Text(service.libelle))
                  .toList(),
            ),
            const SizedBox(height: 16.0),
            const Text(
              'Email :',
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            GestureDetector(
              onTap: () async {
                final Uri emailLaunchUri = Uri(
                  scheme: 'mailto',
                  path: personne!.email,
                  query: encodeQueryParameters(<String, String>{
                    'subject': 'Sujet de l\'email',
                  }),
                );

                if (await canLaunchUrl(emailLaunchUri)) {
                  await launchUrl(emailLaunchUri);
                } else {
                  throw 'Could not launch $emailLaunchUri';
                }
              },
              child: Text(
                personne!.email,
                style: const TextStyle(
                  decoration: TextDecoration.underline,
                  color: Colors.blue,
                ),
              ),
            ),
            const Text(''),
            const Text(
              'Numéro de bureau :',
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            Text(personne!.numBur),
            const SizedBox(height: 16.0),
            const Text(
              'Téléphone :',
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: personne!.numTel
                  .map((telephone) => Text(telephone.tel))
                  .toList(),
            ),
            const SizedBox(height: 16.0),
            const Text(
              'Fonctions :',
              style: TextStyle(fontWeight: FontWeight.bold),
            ),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: fonctions
                  .map((fonction) => Text('- ${fonction.libelle}'))
                  .toList(),
            ),
          ],
        ),
      ),
    );
  }

  String? encodeQueryParameters(Map<String, String> params) {
    return params.entries
        .map((e) =>
            '${Uri.encodeComponent(e.key)}=${Uri.encodeComponent(e.value)}')
        .join('&');
  }
}
