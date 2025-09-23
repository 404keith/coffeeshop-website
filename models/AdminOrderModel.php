<?php
declare(strict_types=1);

class AdminOrderModel
{
    public ?int $id;
    public ?int $user_id;
    public string $order_type;
    public float $total;
    public string $status;
    public string $full_name;
    public string $address;
    public string $phone;
    public ?string $created_at;

    public function __construct(array $data)
    {
        $this->id         = isset($data['id']) ? (int)$data['id'] : null;
        $this->user_id    = isset($data['user_id']) ? (int)$data['user_id'] : null;
        $this->order_type = $data['order_type'] ?? '';
        $this->total      = isset($data['total']) ? (float)$data['total'] : 0.0;
        $this->status     = $data['status'] ?? 'Pending';
        $this->full_name  = $data['full_name'] ?? '';
        $this->address    = $data['address'] ?? '';
        $this->phone      = $data['phone'] ?? '';
        $this->created_at = $data['created_at'] ?? null;
    }
}
