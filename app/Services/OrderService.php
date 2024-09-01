<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\OrderRepository;
use App\DataTransferObjects\OrderDataParam;
use App\Models\Merchant;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderService
{
    private const MAX_TAB_DEFAULT = 10;

    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->orderRepository->paginate();
    }

    public function initOrder(OrderDataParam $orderDataParam): void
    {
        $this->orderRepository->save($orderDataParam);
    }

    public function getAvailableTabsByMerchant(Merchant $merchant): array
    {
        $maxTabs = $merchant->getTabsTotal() ? $merchant->getTabsTotal() : self::MAX_TAB_DEFAULT;
        $unavailableTabs = $this->orderRepository->getUnavailableTabs($merchant->id);

        $availableTabs = [];
        for ($i = 1; $i <= $maxTabs; $i++) {
            if (!in_array($i, $unavailableTabs)) {
                $availableTabs[] = $i;
            }
        }

        return $availableTabs;
    }
}
