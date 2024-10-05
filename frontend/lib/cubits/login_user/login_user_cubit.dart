import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:frontend/models/requests/requests.dart';
import 'package:freezed_annotation/freezed_annotation.dart';
import 'package:frontend/blocs/blocs.dart';
import 'package:frontend/repositories/repositories.dart';
import 'package:flutter_login/flutter_login.dart';

part 'login_user_state.dart';
part 'login_user_cubit.freezed.dart';

class LoginUserCubit extends Cubit<LoginUserState> {
  final AuthRepository _authRepository;
  final AuthBloc _authBloc;

  LoginUserCubit({
    required AuthRepository authRepository,
    required AuthBloc authBloc,
  })  : _authRepository = authRepository,
        _authBloc = authBloc,
        super(
          const LoginUserState.initial(),
        );

  Future<String?> signIn(LoginData data) async {
    //debugging
    print(
        'Login data - Phone Number: ${data.name}, Password: ${data.password}');

    final response = await _authRepository.login(
      LoginRequest(phoneNumber: data.name, password: data.password),
    );
    //still debugging
    if (response.success) {
      _authBloc.add(Authenticated(
        isAuthenticated: true,
        token: response.data!.token,
        user: response.data!.user,
      ));

      return null;
    }
    return response.message;
  }

  Future<String?> signUp(SignupData data) async {
    final response = await _authRepository.register(
      RegisterRequest(
        firstName: data.additionalSignupData!['firstName']!,
        lastName: data.additionalSignupData!['lastName']!,
        phoneNumber: data.name!,
        password: data.password!,
        passwordConfirmation: data.password!,
      ),
    );
    if (response.success) {
      _authBloc.add(Authenticated(
        isAuthenticated: true,
        token: response.data!.token,
        user: response.data!.user,
      ));

      return null;
    }

    return response.message;
  }

  Future<void> signOut() async {
    _authRepository.logout();
    _authBloc.add(const Authenticated(
      isAuthenticated: false,
      user: null,
      token: null,
    ));
  }
}
