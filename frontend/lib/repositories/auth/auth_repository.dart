import "package:dio/dio.dart";
import "package:frontend/models/models.dart";
import "package:frontend/models/requests/requests.dart";
import 'package:frontend/repositories/auth/base_auth_repository.dart';
import "package:frontend/repositories/core/endpoints.dart";
import "package:frontend/utils/utils.dart";

class AuthRepository extends BaseAuthRepository {
  AuthRepository({
    Dio? dioClient,
  }) : _dioClient = dioClient ?? DioClient().instance;

  final Dio _dioClient;

  @override
  Future<AppResponse<AuthUser?>> login(LoginRequest request) async {
    final response = await _dioClient.post(
      Endpoints.login,
      data: request.toJson(),
    );

    return AppResponse<AuthUser?>.fromJson(
      response.data,
      (dynamic json) {
        if (json != null) {
          return AuthUser(
            user: extractUserFromJson(json['user']),
            token: json['access_token'] ?? '',
            tokenType: json['token_type'] ?? '',
            expiresIn: json['expires_in'] ?? 0,
          );
        }
        return null;
      },
    );
  }

  @override
  Future<AppResponse> logout() async {
    final response = await _dioClient.get(Endpoints.logout);

    return AppResponse.fromJson(response.data, (dynamic json) => null);
  }

  @override
  Future<AppResponse<AuthUser?>> register(RegisterRequest request) async {
    final response = await _dioClient.post(
      Endpoints.register,
      data: request.toJson(),
    );

    return AppResponse<AuthUser?>.fromJson(
      response.data,
      (dynamic json) {
        if (json != null && json is Map<String, dynamic>) {
          return AuthUser(
            user: extractUserFromJson(json['user']),
            token: response.data['access_token'] ?? '',
            tokenType: response.data['token_type'] ?? '',
            expiresIn: response.data['expires_in'] ?? 0,
          );
        }
        return null;
      },
    );
  }
}
