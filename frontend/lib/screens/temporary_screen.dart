import 'package:flutter/material.dart';

class TemporaryScreen extends StatelessWidget {
  const TemporaryScreen({super.key});

  static const routeName = "welcome";

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Welcome to JAVA app'),
        actions: [
          IconButton(
              onPressed: () {
                print('logout');
              },
              icon: const Icon(Icons.logout_rounded))
        ],
      ),
      body: const Center(
        child: Text(
          'Welcome to JAVA app',
          style: TextStyle(fontSize: 24),
        ),
      ),
    );
  }
}
