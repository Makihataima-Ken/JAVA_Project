// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'upload_order_request.dart';

// **************************************************************************
// JsonSerializableGenerator
// **************************************************************************

_$UploadOrderRequestImpl _$$UploadOrderRequestImplFromJson(
        Map<String, dynamic> json) =>
    _$UploadOrderRequestImpl(
      universityName: json['university'] as String,
      majorName: json['major'] as String,
      orderType: json['type'] as String,
      orderDescription: json['description'] as String,
      deadline: json['deadline'] as String,
    );

Map<String, dynamic> _$$UploadOrderRequestImplToJson(
        _$UploadOrderRequestImpl instance) =>
    <String, dynamic>{
      'university': instance.universityName,
      'major': instance.majorName,
      'type': instance.orderType,
      'description': instance.orderDescription,
      'deadline': instance.deadline,
    };
