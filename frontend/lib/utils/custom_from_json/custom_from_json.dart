import 'package:frontend/models/models.dart';

UserEntity extractUserFromJson(Map<String, dynamic> json) {
  return UserEntity(
    name: json['first_name'],
    lastname: json['last_name'],
    phone: json['phone_number'],
    usertype: json['usertype'],
    createdAt: DateTime.tryParse(json['created_at']) ?? DateTime.now(),
    updatedAt: DateTime.tryParse(json['updated_at']) ?? DateTime.now(),
    id: json['id'],
  );
}
