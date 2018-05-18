<?php

namespace WSSMS\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketInvoice extends Model 
{

    protected $table = 'tickethasinvoice';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('ticket_id', 'invoice_id');
    protected $visible = array('ticket_id', 'invoice_id');

}