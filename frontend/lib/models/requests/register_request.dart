import 'package:freezed_annotation/freezed_annotation.dart';

part 'register_request.freezed.dart';
part 'register_request.g.dart';

@freezed
class RegisterRequest with _$RegisterRequest {
  factory RegisterRequest({
    required String phoneNumber,
    required String password,
    //ignore: invalid_annotation_target
    @JsonKey(name: "password_confirmation")
    required String passwordConfirmation,
  }) = _RegisterRequest;

  factory RegisterRequest.fromJson(Map<String, dynamic> json) =>
      _$RegisterRequestFromJson(json);
}
