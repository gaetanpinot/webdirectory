import 'package:flutter/material.dart';

class UserList extends StatelessWidget {
  final List<Map<String, dynamic>> filteredNames;
  final void Function(int index) onTap;

  UserList({required this.filteredNames, required this.onTap});

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
      itemCount: filteredNames.length,
      itemBuilder: (BuildContext context, int index) {
        return ListTile(
          leading: filteredNames[index]['imageUrl'] != null
              ? CircleAvatar(
                  backgroundImage:
                      NetworkImage(filteredNames[index]['imageUrl']),
                )
              : CircleAvatar(), 
          title: Text(filteredNames[index]['nom']),
          subtitle: Text(filteredNames[index]['prenom']),
          onTap: () => onTap(index),
        );
      },
    );
  }
}
