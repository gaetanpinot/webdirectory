class Service {
  final String libelle;
  final int id;
  Service({required this.libelle, required this.id});

  factory Service.fromJson(Map<String, dynamic> json) {
    return Service(libelle: json['libelle'], id: json['id']);
  }
}
