class Personne {
  final int id;
  final String nom;
  final String prenom;
  final List<Map<String, dynamic>> service; 

  Personne({
    required this.id,
    required this.nom,
    required this.prenom,
    required this.service,
  });

  factory Personne.fromJson(Map<String, dynamic> json) {
    return Personne(
      id: json['id'],
      nom: json['nom'],
      prenom: json['prenom'],
      service: List<Map<String, dynamic>>.from(json['service']), 
    );
  }
}
