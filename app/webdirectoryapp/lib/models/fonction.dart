class Fonction {
  final int id;
  final String libelle;

  Fonction({
    required this.id,
    required this.libelle,
  });

  factory Fonction.fromJson(Map<String, dynamic> json) {
    return Fonction(
      id: json['id'],
      libelle: json['libelle'],
    );
  }
}
