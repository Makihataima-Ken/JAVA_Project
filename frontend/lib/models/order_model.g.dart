// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'order_model.dart';

// **************************************************************************
// JsonSerializableGenerator
// **************************************************************************

_$OrderEntityImpl _$$OrderEntityImplFromJson(Map<String, dynamic> json) =>
    _$OrderEntityImpl(
      universityName: json['university'] as String,
      majorName: json['major'] as String,
      orderType: json['type'] as String,
      orderDescription: json['description'] as String,
      deadline: json['deadline'] as String,
    );

Map<String, dynamic> _$$OrderEntityImplToJson(_$OrderEntityImpl instance) =>
    <String, dynamic>{
      'university': instance.universityName,
      'major': instance.majorName,
      'type': instance.orderType,
      'description': instance.orderDescription,
      'deadline': instance.deadline,
    };
