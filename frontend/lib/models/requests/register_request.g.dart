// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'register_request.dart';

// **************************************************************************
// JsonSerializableGenerator
// **************************************************************************

_$RegisterRequestImpl _$$RegisterRequestImplFromJson(
        Map<String, dynamic> json) =>
    _$RegisterRequestImpl(
      phoneNumber: json['phoneNumber'] as String,
      password: json['password'] as String,
      passwordConfirmation: json['password_confirmation'] as String,
    );

Map<String, dynamic> _$$RegisterRequestImplToJson(
        _$RegisterRequestImpl instance) =>
    <String, dynamic>{
      'phoneNumber': instance.phoneNumber,
      'password': instance.password,
      'password_confirmation': instance.passwordConfirmation,
    };
