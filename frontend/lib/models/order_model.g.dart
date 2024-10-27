// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'order_model.dart';

// **************************************************************************
// JsonSerializableGenerator
// **************************************************************************

_$OrderEntityImpl _$$OrderEntityImplFromJson(Map<String, dynamic> json) =>
    _$OrderEntityImpl(
      id: (json['id'] as num).toInt(),
      universityName: json['university'] as String,
      majorName: json['major'] as String,
      orderType: json['type'] as String,
      orderDescription: json['description'] as String,
      deadline: json['deadline'] as String,
    );

Map<String, dynamic> _$$OrderEntityImplToJson(_$OrderEntityImpl instance) =>
    <String, dynamic>{
      'id': instance.id,
      'university': instance.universityName,
      'major': instance.majorName,
      'type': instance.orderType,
      'description': instance.orderDescription,
      'deadline': instance.deadline,
    };

_$NewOrderImpl _$$NewOrderImplFromJson(Map<String, dynamic> json) =>
    _$NewOrderImpl(
      orderCreatedAt: json['created_at'] as String,
      order: OrderEntity.fromJson(json['order'] as Map<String, dynamic>),
    );

Map<String, dynamic> _$$NewOrderImplToJson(_$NewOrderImpl instance) =>
    <String, dynamic>{
      'created_at': instance.orderCreatedAt,
      'order': instance.order,
    };
