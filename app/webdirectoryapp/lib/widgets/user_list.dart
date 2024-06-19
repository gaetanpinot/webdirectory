import 'package:flutter/material.dart';
import 'package:webdirectoryapp/models/detail.dart';
import 'package:webdirectoryapp/models/service.dart';

class UserList extends StatelessWidget {
  final List<Detail> filteredNames;
  final void Function(int index) onTap;

  const UserList({super.key, required this.filteredNames, required this.onTap});

  String getLibelles(List<Service> services) {
    return services.map((e) => e.getLibelle()).join(', ');
  }

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
      itemCount: filteredNames.length,
      itemBuilder: (BuildContext context, int index) {
        return ListTile(
          leading: filteredNames[index].imgUrl.isNotEmpty
              ? CircleAvatar(
                  backgroundImage: NetworkImage(filteredNames[index].imgUrl),
                )
              : const CircleAvatar(),
          title: Text(
              '${filteredNames[index].getNom()} ${filteredNames[index].getPrenom()}'),
          subtitle: Text(getLibelles(filteredNames[index].service)),
          onTap: () => onTap(index),
        );
      },
    );
  }
}
