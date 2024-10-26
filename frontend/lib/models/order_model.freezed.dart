// coverage:ignore-file
// GENERATED CODE - DO NOT MODIFY BY HAND
// ignore_for_file: type=lint
// ignore_for_file: unused_element, deprecated_member_use, deprecated_member_use_from_same_package, use_function_type_syntax_for_parameters, unnecessary_const, avoid_init_to_null, invalid_override_different_default_values_named, prefer_expression_function_bodies, annotate_overrides, invalid_annotation_target, unnecessary_question_mark

part of 'order_model.dart';

// **************************************************************************
// FreezedGenerator
// **************************************************************************

T _$identity<T>(T value) => value;

final _privateConstructorUsedError = UnsupportedError(
    'It seems like you constructed your class using `MyClass._()`. This constructor is only meant to be used by freezed and you are not supposed to need it nor use it.\nPlease check the documentation here for more information: https://github.com/rrousselGit/freezed#adding-getters-and-methods-to-our-models');

OrderEntity _$OrderEntityFromJson(Map<String, dynamic> json) {
  return _OrderEntity.fromJson(json);
}

/// @nodoc
mixin _$OrderEntity {
  int get id => throw _privateConstructorUsedError;
  @JsonKey(name: 'university')
  String get universityName => throw _privateConstructorUsedError;
  @JsonKey(name: 'major')
  String get majorName => throw _privateConstructorUsedError;
  @JsonKey(name: 'type')
  String get orderType => throw _privateConstructorUsedError;
  @JsonKey(name: 'description')
  String get orderDescription => throw _privateConstructorUsedError;
  @JsonKey(name: 'deadline')
  String get deadline => throw _privateConstructorUsedError;
  @JsonKey(includeFromJson: false, includeToJson: false)
  File? get file => throw _privateConstructorUsedError;

  Map<String, dynamic> toJson() => throw _privateConstructorUsedError;
  @JsonKey(ignore: true)
  $OrderEntityCopyWith<OrderEntity> get copyWith =>
      throw _privateConstructorUsedError;
}

/// @nodoc
abstract class $OrderEntityCopyWith<$Res> {
  factory $OrderEntityCopyWith(
          OrderEntity value, $Res Function(OrderEntity) then) =
      _$OrderEntityCopyWithImpl<$Res, OrderEntity>;
  @useResult
  $Res call(
      {int id,
      @JsonKey(name: 'university') String universityName,
      @JsonKey(name: 'major') String majorName,
      @JsonKey(name: 'type') String orderType,
      @JsonKey(name: 'description') String orderDescription,
      @JsonKey(name: 'deadline') String deadline,
      @JsonKey(includeFromJson: false, includeToJson: false) File? file});
}

/// @nodoc
class _$OrderEntityCopyWithImpl<$Res, $Val extends OrderEntity>
    implements $OrderEntityCopyWith<$Res> {
  _$OrderEntityCopyWithImpl(this._value, this._then);

  // ignore: unused_field
  final $Val _value;
  // ignore: unused_field
  final $Res Function($Val) _then;

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? id = null,
    Object? universityName = null,
    Object? majorName = null,
    Object? orderType = null,
    Object? orderDescription = null,
    Object? deadline = null,
    Object? file = freezed,
  }) {
    return _then(_value.copyWith(
      id: null == id
          ? _value.id
          : id // ignore: cast_nullable_to_non_nullable
              as int,
      universityName: null == universityName
          ? _value.universityName
          : universityName // ignore: cast_nullable_to_non_nullable
              as String,
      majorName: null == majorName
          ? _value.majorName
          : majorName // ignore: cast_nullable_to_non_nullable
              as String,
      orderType: null == orderType
          ? _value.orderType
          : orderType // ignore: cast_nullable_to_non_nullable
              as String,
      orderDescription: null == orderDescription
          ? _value.orderDescription
          : orderDescription // ignore: cast_nullable_to_non_nullable
              as String,
      deadline: null == deadline
          ? _value.deadline
          : deadline // ignore: cast_nullable_to_non_nullable
              as String,
      file: freezed == file
          ? _value.file
          : file // ignore: cast_nullable_to_non_nullable
              as File?,
    ) as $Val);
  }
}

/// @nodoc
abstract class _$$OrderEntityImplCopyWith<$Res>
    implements $OrderEntityCopyWith<$Res> {
  factory _$$OrderEntityImplCopyWith(
          _$OrderEntityImpl value, $Res Function(_$OrderEntityImpl) then) =
      __$$OrderEntityImplCopyWithImpl<$Res>;
  @override
  @useResult
  $Res call(
      {int id,
      @JsonKey(name: 'university') String universityName,
      @JsonKey(name: 'major') String majorName,
      @JsonKey(name: 'type') String orderType,
      @JsonKey(name: 'description') String orderDescription,
      @JsonKey(name: 'deadline') String deadline,
      @JsonKey(includeFromJson: false, includeToJson: false) File? file});
}

/// @nodoc
class __$$OrderEntityImplCopyWithImpl<$Res>
    extends _$OrderEntityCopyWithImpl<$Res, _$OrderEntityImpl>
    implements _$$OrderEntityImplCopyWith<$Res> {
  __$$OrderEntityImplCopyWithImpl(
      _$OrderEntityImpl _value, $Res Function(_$OrderEntityImpl) _then)
      : super(_value, _then);

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? id = null,
    Object? universityName = null,
    Object? majorName = null,
    Object? orderType = null,
    Object? orderDescription = null,
    Object? deadline = null,
    Object? file = freezed,
  }) {
    return _then(_$OrderEntityImpl(
      id: null == id
          ? _value.id
          : id // ignore: cast_nullable_to_non_nullable
              as int,
      universityName: null == universityName
          ? _value.universityName
          : universityName // ignore: cast_nullable_to_non_nullable
              as String,
      majorName: null == majorName
          ? _value.majorName
          : majorName // ignore: cast_nullable_to_non_nullable
              as String,
      orderType: null == orderType
          ? _value.orderType
          : orderType // ignore: cast_nullable_to_non_nullable
              as String,
      orderDescription: null == orderDescription
          ? _value.orderDescription
          : orderDescription // ignore: cast_nullable_to_non_nullable
              as String,
      deadline: null == deadline
          ? _value.deadline
          : deadline // ignore: cast_nullable_to_non_nullable
              as String,
      file: freezed == file
          ? _value.file
          : file // ignore: cast_nullable_to_non_nullable
              as File?,
    ));
  }
}

/// @nodoc
@JsonSerializable()
class _$OrderEntityImpl implements _OrderEntity {
  _$OrderEntityImpl(
      {required this.id,
      @JsonKey(name: 'university') required this.universityName,
      @JsonKey(name: 'major') required this.majorName,
      @JsonKey(name: 'type') required this.orderType,
      @JsonKey(name: 'description') required this.orderDescription,
      @JsonKey(name: 'deadline') required this.deadline,
      @JsonKey(includeFromJson: false, includeToJson: false) this.file});

  factory _$OrderEntityImpl.fromJson(Map<String, dynamic> json) =>
      _$$OrderEntityImplFromJson(json);

  @override
  final int id;
  @override
  @JsonKey(name: 'university')
  final String universityName;
  @override
  @JsonKey(name: 'major')
  final String majorName;
  @override
  @JsonKey(name: 'type')
  final String orderType;
  @override
  @JsonKey(name: 'description')
  final String orderDescription;
  @override
  @JsonKey(name: 'deadline')
  final String deadline;
  @override
  @JsonKey(includeFromJson: false, includeToJson: false)
  final File? file;

  @override
  String toString() {
    return 'OrderEntity(id: $id, universityName: $universityName, majorName: $majorName, orderType: $orderType, orderDescription: $orderDescription, deadline: $deadline, file: $file)';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType &&
            other is _$OrderEntityImpl &&
            (identical(other.id, id) || other.id == id) &&
            (identical(other.universityName, universityName) ||
                other.universityName == universityName) &&
            (identical(other.majorName, majorName) ||
                other.majorName == majorName) &&
            (identical(other.orderType, orderType) ||
                other.orderType == orderType) &&
            (identical(other.orderDescription, orderDescription) ||
                other.orderDescription == orderDescription) &&
            (identical(other.deadline, deadline) ||
                other.deadline == deadline) &&
            (identical(other.file, file) || other.file == file));
  }

  @JsonKey(ignore: true)
  @override
  int get hashCode => Object.hash(runtimeType, id, universityName, majorName,
      orderType, orderDescription, deadline, file);

  @JsonKey(ignore: true)
  @override
  @pragma('vm:prefer-inline')
  _$$OrderEntityImplCopyWith<_$OrderEntityImpl> get copyWith =>
      __$$OrderEntityImplCopyWithImpl<_$OrderEntityImpl>(this, _$identity);

  @override
  Map<String, dynamic> toJson() {
    return _$$OrderEntityImplToJson(
      this,
    );
  }
}

abstract class _OrderEntity implements OrderEntity {
  factory _OrderEntity(
      {required final int id,
      @JsonKey(name: 'university') required final String universityName,
      @JsonKey(name: 'major') required final String majorName,
      @JsonKey(name: 'type') required final String orderType,
      @JsonKey(name: 'description') required final String orderDescription,
      @JsonKey(name: 'deadline') required final String deadline,
      @JsonKey(includeFromJson: false, includeToJson: false)
      final File? file}) = _$OrderEntityImpl;

  factory _OrderEntity.fromJson(Map<String, dynamic> json) =
      _$OrderEntityImpl.fromJson;

  @override
  int get id;
  @override
  @JsonKey(name: 'university')
  String get universityName;
  @override
  @JsonKey(name: 'major')
  String get majorName;
  @override
  @JsonKey(name: 'type')
  String get orderType;
  @override
  @JsonKey(name: 'description')
  String get orderDescription;
  @override
  @JsonKey(name: 'deadline')
  String get deadline;
  @override
  @JsonKey(includeFromJson: false, includeToJson: false)
  File? get file;
  @override
  @JsonKey(ignore: true)
  _$$OrderEntityImplCopyWith<_$OrderEntityImpl> get copyWith =>
      throw _privateConstructorUsedError;
}

NewOrder _$NewOrderFromJson(Map<String, dynamic> json) {
  return _NewOrder.fromJson(json);
}

/// @nodoc
mixin _$NewOrder {
  @JsonKey(name: 'created_at')
  String get orderCreatedAt => throw _privateConstructorUsedError;
  @JsonKey(name: 'order')
  OrderEntity get order => throw _privateConstructorUsedError;

  Map<String, dynamic> toJson() => throw _privateConstructorUsedError;
  @JsonKey(ignore: true)
  $NewOrderCopyWith<NewOrder> get copyWith =>
      throw _privateConstructorUsedError;
}

/// @nodoc
abstract class $NewOrderCopyWith<$Res> {
  factory $NewOrderCopyWith(NewOrder value, $Res Function(NewOrder) then) =
      _$NewOrderCopyWithImpl<$Res, NewOrder>;
  @useResult
  $Res call(
      {@JsonKey(name: 'created_at') String orderCreatedAt,
      @JsonKey(name: 'order') OrderEntity order});

  $OrderEntityCopyWith<$Res> get order;
}

/// @nodoc
class _$NewOrderCopyWithImpl<$Res, $Val extends NewOrder>
    implements $NewOrderCopyWith<$Res> {
  _$NewOrderCopyWithImpl(this._value, this._then);

  // ignore: unused_field
  final $Val _value;
  // ignore: unused_field
  final $Res Function($Val) _then;

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? orderCreatedAt = null,
    Object? order = null,
  }) {
    return _then(_value.copyWith(
      orderCreatedAt: null == orderCreatedAt
          ? _value.orderCreatedAt
          : orderCreatedAt // ignore: cast_nullable_to_non_nullable
              as String,
      order: null == order
          ? _value.order
          : order // ignore: cast_nullable_to_non_nullable
              as OrderEntity,
    ) as $Val);
  }

  @override
  @pragma('vm:prefer-inline')
  $OrderEntityCopyWith<$Res> get order {
    return $OrderEntityCopyWith<$Res>(_value.order, (value) {
      return _then(_value.copyWith(order: value) as $Val);
    });
  }
}

/// @nodoc
abstract class _$$NewOrderImplCopyWith<$Res>
    implements $NewOrderCopyWith<$Res> {
  factory _$$NewOrderImplCopyWith(
          _$NewOrderImpl value, $Res Function(_$NewOrderImpl) then) =
      __$$NewOrderImplCopyWithImpl<$Res>;
  @override
  @useResult
  $Res call(
      {@JsonKey(name: 'created_at') String orderCreatedAt,
      @JsonKey(name: 'order') OrderEntity order});

  @override
  $OrderEntityCopyWith<$Res> get order;
}

/// @nodoc
class __$$NewOrderImplCopyWithImpl<$Res>
    extends _$NewOrderCopyWithImpl<$Res, _$NewOrderImpl>
    implements _$$NewOrderImplCopyWith<$Res> {
  __$$NewOrderImplCopyWithImpl(
      _$NewOrderImpl _value, $Res Function(_$NewOrderImpl) _then)
      : super(_value, _then);

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? orderCreatedAt = null,
    Object? order = null,
  }) {
    return _then(_$NewOrderImpl(
      orderCreatedAt: null == orderCreatedAt
          ? _value.orderCreatedAt
          : orderCreatedAt // ignore: cast_nullable_to_non_nullable
              as String,
      order: null == order
          ? _value.order
          : order // ignore: cast_nullable_to_non_nullable
              as OrderEntity,
    ));
  }
}

/// @nodoc
@JsonSerializable()
class _$NewOrderImpl implements _NewOrder {
  _$NewOrderImpl(
      {@JsonKey(name: 'created_at') required this.orderCreatedAt,
      @JsonKey(name: 'order') required this.order});

  factory _$NewOrderImpl.fromJson(Map<String, dynamic> json) =>
      _$$NewOrderImplFromJson(json);

  @override
  @JsonKey(name: 'created_at')
  final String orderCreatedAt;
  @override
  @JsonKey(name: 'order')
  final OrderEntity order;

  @override
  String toString() {
    return 'NewOrder(orderCreatedAt: $orderCreatedAt, order: $order)';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType &&
            other is _$NewOrderImpl &&
            (identical(other.orderCreatedAt, orderCreatedAt) ||
                other.orderCreatedAt == orderCreatedAt) &&
            (identical(other.order, order) || other.order == order));
  }

  @JsonKey(ignore: true)
  @override
  int get hashCode => Object.hash(runtimeType, orderCreatedAt, order);

  @JsonKey(ignore: true)
  @override
  @pragma('vm:prefer-inline')
  _$$NewOrderImplCopyWith<_$NewOrderImpl> get copyWith =>
      __$$NewOrderImplCopyWithImpl<_$NewOrderImpl>(this, _$identity);

  @override
  Map<String, dynamic> toJson() {
    return _$$NewOrderImplToJson(
      this,
    );
  }
}

abstract class _NewOrder implements NewOrder {
  factory _NewOrder(
          {@JsonKey(name: 'created_at') required final String orderCreatedAt,
          @JsonKey(name: 'order') required final OrderEntity order}) =
      _$NewOrderImpl;

  factory _NewOrder.fromJson(Map<String, dynamic> json) =
      _$NewOrderImpl.fromJson;

  @override
  @JsonKey(name: 'created_at')
  String get orderCreatedAt;
  @override
  @JsonKey(name: 'order')
  OrderEntity get order;
  @override
  @JsonKey(ignore: true)
  _$$NewOrderImplCopyWith<_$NewOrderImpl> get copyWith =>
      throw _privateConstructorUsedError;
}
