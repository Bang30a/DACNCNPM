# 🧩 Project README – Workflow for Team (Trường, Long, Dũng)

## 📌 Giới thiệu
Đây là hướng dẫn làm việc nhóm với Git cho dự án, bao gồm cách phân nhánh, quy tắc commit, và quy trình merge.

---

# 🚀 Quy trình làm việc Git (Git Workflow)
Dự án sử dụng mô hình phân nhánh đơn giản và hiệu quả:

```
main        → Nhánh chính, chỉ chứa code ổn định
develop     → Nhánh phát triển chung
truong-dev  → Nhánh của Trường
long-dev    → Nhánh của Long
dung-dev    → Nhánh của Dũng
```

---

# 👥 Branch dành cho từng thành viên

### **Trường:**
```
git checkout truong-dev
```

### **Long:**
```
git checkout long-dev
```

### **Dũng:**
```
git checkout dung-dev
```

Mỗi người chỉ làm việc trên nhánh của riêng mình.

---

# 🔄 Cách thao tác với Git hằng ngày

## 🟦 1. Lấy code mới nhất
```
git pull
```

## 🟦 2. Thêm thay đổi
```
git add .
```

## 🟦 3. Commit
```
git commit -m "Mo ta ngan gon thay doi cua ban"
```

## 🟦 4. Push lên GitHub
```
git push
```

---

# 📝 Quy tắc đặt commit
Để mọi thứ rõ ràng, commit nên có format:

```
[type] mô tả
```

### **Các type phổ biến:**
- `feat:` thêm tính năng
- `fix:` sửa lỗi
- `update:` cập nhật code
- `refactor:` cải tiến code, không đổi logic
- `doc:` chỉnh tài liệu

### Ví dụ:
```
feat: thêm màn hình login
fix: sửa lỗi không load được avatar
update: tối ưu hóa thuật toán tìm đường
```

---

# 🔀 Quy trình Merge Code

## Khi Long hoặc Dũng hoàn thành một tính năng:
1. Push code lên nhánh của mình  
2. Mở **Pull Request** từ  
   **long-dev → develop**  
   hoặc  
   **dung-dev → develop**
3. Trường review code  
4. Nếu OK → Merge vào develop

## Khi develop ổn định:
- Trường thực hiện merge:  
  **develop → main**

---

# 🔐 Phân quyền GitHub (Collaborators)
Chủ repo (Trường) mời Long & Dũng vào:

GitHub → Settings → Collaborators → Add People

---

# 📦 Quy tắc làm việc với file nặng (LFS)
Các file lớn hơn 100MB phải dùng Git LFS.

Ví dụ thêm file vào LFS:
```
git lfs track "*.exe"
git add .gitattributes
```

---

# 📄 Ghi chú quan trọng
- Tuyệt đối **không commit file secret, token, serviceAccountKey.json**
- Không làm việc trực tiếp trên `main` hoặc `develop`
- Nếu gặp xung đột (conflict), liên hệ Trường để giải quyết

---

# ❤️ Tinh thần làm việc nhóm
- Rõ ràng
- Gọn gàng
- Code sạch
- Commit rõ ràng
- Không đẩy file lung tung


**Chúc cả nhóm code vui vẻ và làm việc hiệu quả!** 🚀