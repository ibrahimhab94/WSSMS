<?php

/**
 * Created by PhpStorm.
 * User: ihaboush
 * Date: 3/1/18
 * Time: 12:49 PM
 */
return [
    'CustomersController' => "الزبائن",
    'options' => "--",
    'coming_soon' => 'قريباً',
    'mobile'=>'الجوال',
    'employees'=>[
      'name'=>'الموظف',
      'status'=>'الحالة',
      'states_target'=>'المهام',
      'states_done'=>'المهام المنجزة',
      'states_fail'=>'مهام لم تنجز',
      'customers_rate'=>'تقييم العملاء',
      'user_rate'=>'تقييم المستخدمين',
      'status_list'=>[0=>'انتظار',],

    ],
    'customers' => [
        'customers' => 'الزبائن',
        'list' => 'الزبائن والعملاء',
        'id' => 'متسلسل',
        'name' => 'الإسم',
        'address' => 'العنوان',
        'address_details' => 'العنوان مع التفاصيل ',
        'add' => 'أضافة عميل',
        'add_form' => 'نموذج أضافة عميل',
        'add_form_action' => ' أضافة عميل',
        'mobile' => 'محمول',
        'city' => 'المدينة',
        'email' => 'بريد الكتروني',
        'phone' => 'هاتف',
        'status' => 'الحالة',
        'updateform' => 'تعديل عميل',
        'update_success_msg' => 'تم تعديل بيانات العميل :NAME بنجاح ...',
        'update_success' => 'تم تعديل بيانات العميل',
    ],
    'customerservice' => [
        'customerservice' => 'خدمة الزبائن',
        'waiting_ticket' => 'تذاكر غير منفذة',
        'tickets' => 'التذاكر',
        'add_ticket' => 'تذكرة جديدة',
        'add_ticket_action' => 'إضافة التذكرة',
        'customer_issue' => 'وصف المشكلة',
        'ticket_type' => 'نوع التذكرة',
        'customer_issue_details' => 'وصف دقيق للمشكلة',
        'expected_needs' => 'الاحتياجات المطلوبة',
        'customer_name' => 'العميل',
        'ticket_no' => 'رقم التذكرة',
        'ticket_id' => 'تذكرة رقم',
        'support_ticket' => 'تذكرة دعم فني ',
        'customerorderedtime' => 'الوقت المطلوب',
        'tickets_form' => 'نموذج تذكرة دعم فني',
        'customer_calling_time' => 'وقت اتصال الزبون',
        'executing_tickets' => 'تذاكر قيد التنفيذ',
        'requierd_time' => 'الوقت والتاريخ المطلوب',
        'customer_full_address' => 'عنوان العميل',
        'profile' => [
            'tickets_count' => 'تذاكر سابقة',
            'invoice_count' => 'فواتير سابقة',
            'recent_activity' => 'آخر الفعاليات',
            'current_activty' => 'نشاطات حالية'
        ],
        'ticket' => [
            'customer_name' => 'اسم العميل',
            'ticket_status' => 'حالة التذكرة',
            'ticket_employee' => 'الموظف المسؤول',
            'ticket_opener' => 'محرر التذكرة',
            'ticket_not_associated' => 'التذكرة بدون موظف',
            'ticket_not_executed' => 'تذكرة غير منفذة',
            'execute_ticket' => 'تنفيذ التذكرة',
            'close_ticket' => 'إغلاق التذكرة',
        ],
        'ticket_status'=>[
            0=>'انتظار'
        ],
        'send_sms' => 'ارسال رسالة SMS',
    ],
    'invoices' => [
        'invoice_no' => 'رقم الفاتورة',
        'search_for_invoice' => 'بحث عن فاتورة'
    ]
];
