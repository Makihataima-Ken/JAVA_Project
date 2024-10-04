import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:flutter_login/flutter_login.dart';
import 'package:frontend/cubits/cubits.dart';
import 'package:frontend/screens/screens.dart';

class LoginScreen extends StatelessWidget {
  const LoginScreen({super.key});

  static const routeName = "login";

  @override
  Widget build(BuildContext context) {
    final cubit = context.read<LoginUserCubit>();

    return FlutterLogin(
      scrollable: true,
      hideForgotPasswordButton: true,
      title: 'Java App',
      theme: LoginTheme(
        titleStyle: const TextStyle(
          fontSize: 24,
          fontWeight: FontWeight.bold,
        ),
        pageColorDark: Colors.blue,
        pageColorLight: Colors.blue.shade300,
      ),
      logo: const AssetImage('assets/images/JAVA_Project.png'),
      loginProviders: [],
      onLogin: cubit.signIn,
      onSignup: cubit.signUp,
      userValidator: (value) {
        if (value == null ||
            !value.contains('09') ||
            value.length < 10 ||
            value.length > 10) {
          return 'Invalid phone number, try 09xxxxxxxx';
        }
        return null;
      },
      passwordValidator: (value) {
        if (value == null || value.length < 8) {
          return "Password must be at least 8 chars";
        }
        return null;
      },
      onSubmitAnimationCompleted: () {
        Navigator.of(context).pushReplacementNamed(TemporaryScreen.routeName);
      },
      onRecoverPassword: (_) async => null,
    );
  }
}
