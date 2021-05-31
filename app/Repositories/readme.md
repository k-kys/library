> liệt kê các func trong từng repo.
> func được viết _innghiêng_ là các func được viết lại từ repo gốc để phù hợp truy vấn

# Repository gốc:

-   getAll(); ` -- sort by name`
-   query();
-   find($id);
-   search($keyword); ` -- orderby name`
-   _index($keyword);_
-   _create(array $attributes);_
-   _update($id, array $attributes);_
-   _delete($id);_

## AdminRepository

-   getRole();
-   getPermission();
-   _create(array $data);_
-   updateProfile($id, $attributes);

## BookRepository

-   getCategory();
-   getMajor();
-   _create($data);_
-   updateBook($id, $data);
-   checkBook($id)

## BorrowpayRepository

-   getBorrowPay();
-   searchStudentOrBook($keyword);
-   getStudent();
-   getBook();
-   getDateBorrow();
-   getDueDate($dateExpiry);
-   getFine($dueDate);
-   studentBorrowPay($id, $keyword);
-   _index($keyword);_
-   show($id);
-   _create(array $data);_
-   updateBorrow($id, $data);
-   returnBorrow($id, $data);
-   _delete($id);_

## CategoryRepository

## MajorRepository

## PermissionRepository

## RoleRepository

-   getPermission();
-   _create($data);_
-   _update($id, $data);_

## StudentRepository

-   <!-- Student -->
-   getTotalBook($id);
-   getPaidBook($id);
-   getUnpaidBook($id);
-   getNumberOfPenalties($id);
-   home($keyword);
-   _update($id, $data);_
-   flyResize($size, $imagePath);
-   updatePassword($id, $data);
-   uploadAvatar(Request $request);
-   <!-- Admin -->
-   _create(array $data);_
-   updateStudent($id, $data);
-   block($id);
-   unblock($id);
