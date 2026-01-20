<?php

namespace App\Exports;

use App\Models\StudentFile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentFilesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return StudentFile::select(
            'id',
            'last_name',
            'first_name',
            'diploma_type',
            'submitted_at',
            'received_at',   // ✅ جديد
            'tracking_id',
            'status'
        )->orderBy('id', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'اللقب',
            'الاسم',
            'نوع الشهادة',
            'تاريخ الإيداع',
            'تاريخ الاستلام',   // ✅ جديد
            'رقم التتبع',
            'الحالة'
        ];
    }

    public function map($file): array
    {
        // ✅ تحويل الحالة للعربية
        $statusArabic = match ($file->status) {
            'processed' => 'تم توثيقه',
            'rejected'  => 'مرفوض',
            default     => 'انتظار',
        };

        return [
            $file->id,
            $file->last_name,
            $file->first_name,
            $file->diploma_type,
            $file->submitted_at,
            $file->received_at ?? '-',   // ✅ جديد
            $file->tracking_id,
            $statusArabic
        ];
    }
}
