import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:frontend/models/requests/requests.dart';
import 'package:freezed_annotation/freezed_annotation.dart';
import 'package:frontend/blocs/blocs.dart';
import 'package:frontend/repositories/repositories.dart';
import 'package:flutter_login/flutter_login.dart';
import 'package:frontend/utils/token_storage/token_storage.dart';

part 'login_user_state.dart';
part 'login_user_cubit.freezed.dart';

class LoginUserCubit extends Cubit<LoginUserState> {
  final AuthRepository _authRepository;
  final AuthBloc _authBloc;
  final TokenStorage _tokenStorage = TokenStorage();

  LoginUserCubit({
    required AuthRepository authRepository,
    required AuthBloc authBloc,
  })  : _authRepository = authRepository,
        _authBloc = authBloc,
        super(
          const LoginUserState.initial(),
        );

  Future<String?> signIn(LoginData data) async {
    try {
      final response = await _authRepository.login(
        LoginRequest(phoneNumber: data.name, password: data.password),
      );
      if (response.success) {
        if (response.data != null && response.data!.token.isNotEmpty) {
          await _tokenStorage.saveToken(response.data!.token);
          _authBloc.add(Authenticated(
            isAuthenticated: true,
            token: response.data!.token,
            user: response.data!.user,
          ));
          return null;
        }
      }
      return response.message;
    } catch (e) {
      return 'An error occurred during login';
    }
  }

  Future<String?> signUp(SignupData data) async {
    try {
      final response = await _authRepository.register(
        RegisterRequest(
          firstName: data.additionalSignupData!['first_name']!,
          lastName: data.additionalSignupData!['last_name']!,
          phoneNumber: data.name!,
          password: data.password!,
          passwordConfirmation: data.password!,
        ),
      );

      if (response.success) {
        if (response.data != null && response.data!.token.isNotEmpty) {
          await _tokenStorage.saveToken(response.data!.token);
          _authBloc.add(Authenticated(
            isAuthenticated: true,
            token: response.data!.token,
            user: response.data!.user,
          ));
          return null;
        }
      }
      return response.message;
    } catch (e) {
      return 'An error occurred during signup';
    }
  }

  Future<void> signOut() async {
    await _tokenStorage.deleteToken();
    _authRepository.logout();
    _authBloc.add(const Authenticated(
      isAuthenticated: false,
      user: null,
      token: null,
    ));
  }
}
