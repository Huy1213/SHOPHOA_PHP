from django.db import models

# Create your models here.
class Loai(models.Model):
    MaLoai = models.AutoField(primary_key=True)
    TenLoai = models.CharField(max_length=100)
    def __str__(self):
            return self.TenLoai
class MauSac(models.Model):
    MaMau = models.AutoField(primary_key=True)
    TenMau = models.CharField(max_length=100)
    def __str__(self):
            return self.TenMau
class SanPham(models.Model):
    MaSP = models.AutoField(primary_key=True)
    TenSP = models.CharField(max_length=255)
    MoTa = models.CharField(max_length=500)
    SoLuong = models.PositiveIntegerField()
    DonGia = models.DecimalField(max_digits=10, decimal_places=2)
    HinhAnh = models.ImageField(upload_to='product')
    MaLoai = models.ForeignKey(Loai, on_delete=models.CASCADE)
    MaMau = models.ForeignKey(MauSac, on_delete=models.SET_NULL, null =True)
    def __str__(self):
        return self.TenSP