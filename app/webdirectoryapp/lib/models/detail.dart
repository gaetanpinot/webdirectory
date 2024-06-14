import 'package:webdirectoryapp/models/personne.dart';

class Detail {
  final Personne personne;
  final String url;

  Detail({required this.personne, required this.url});

  factory Detail.fromJson(Map<String, dynamic> json) {
    return Detail(
      personne: Personne.fromJson(json['personne']),
      url: json['url'],
    );
  }
}
