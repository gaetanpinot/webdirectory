import 'package:flutter/material.dart';

import '../models/personne.dart';

class UserList extends StatelessWidget {
  final List<Personne> filteredNames;
  final void Function(int index) onTap;
  final String startUrl = 'https://localhost:44000';

  const UserList({super.key, required this.filteredNames, required this.onTap});

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
      itemCount: filteredNames.length,
      itemBuilder: (BuildContext context, int index) {
        return ListTile(
          leading: filteredNames[index].getUrl() != null
              ? CircleAvatar(
                  backgroundImage:
                      NetworkImage(startUrl + filteredNames[index].getUrl()),
                )
              : const CircleAvatar(),
          title: Text(filteredNames[index].getNom()),
          subtitle: Text(filteredNames[index].getPrenom()),
          onTap: () => onTap(index),
        );
      },
    );
  }
}
