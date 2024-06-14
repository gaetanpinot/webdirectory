import 'package:flutter/material.dart';

class SortButton extends StatelessWidget {
  final VoidCallback onPressed;
  final bool isAscending;

  const SortButton(
      {super.key, required this.onPressed, required this.isAscending});

  @override
  Widget build(BuildContext context) {
    return IconButton(
      icon: Icon(isAscending
          ? Icons.arrow_upward
          : Icons
              .arrow_downward), // Icône de flèche ascendante ou descendante en fonction de l'ordre de tri
      onPressed: onPressed, // Action à exécuter lorsque le bouton est pressé
    );
  }
}
