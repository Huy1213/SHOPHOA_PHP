from django.contrib import admin
from .models import SanPham, Loai
# Register your models here.
@admin.register(SanPham)
class SanPhamModelAdmin(admin.ModelAdmin):
    list_display = ['MaSP','TenSP','DonGia','SoLuong','MaLoai','HinhAnh']
@admin.register(Loai)
class LoaiModelAdmin(admin.ModelAdmin):
    list_display = ['MaLoai','TenLoai']