<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferServicePointAvailability\Business\Expander;

use Generated\Shared\Transfer\SellableItemRequestTransfer;
use Generated\Shared\Transfer\SellableItemResponseTransfer;
use Generated\Shared\Transfer\SellableItemsResponseTransfer;

class SellableItemsResponseExpander implements SellableItemsResponseExpanderInterface
{
    public function expandSellableItemsResponseWithNotSellableItem(
        SellableItemsResponseTransfer $sellableItemsResponseTransfer,
        SellableItemRequestTransfer $sellableItemRequestTransfer
    ): SellableItemsResponseTransfer {
        if (!$this->hasSellableItemsResponseNotSellableItem($sellableItemsResponseTransfer, $sellableItemRequestTransfer)) {
            $sellableItemsResponseTransfer->addSellableItemResponse($this->createNotSellableItemResponseTransfer($sellableItemRequestTransfer));
        }

        return $sellableItemsResponseTransfer;
    }

    protected function hasSellableItemsResponseNotSellableItem(
        SellableItemsResponseTransfer $sellableItemsResponseTransfer,
        SellableItemRequestTransfer $sellableItemRequestTransfer
    ): bool {
        foreach ($sellableItemsResponseTransfer->getSellableItemResponses() as $sellableItemResponseTransfer) {
            if (
                !$sellableItemResponseTransfer->getIsSellable()
                && $sellableItemResponseTransfer->getSkuOrFail() === $sellableItemRequestTransfer->getSkuOrFail()
            ) {
                return true;
            }
        }

        return false;
    }

    protected function createNotSellableItemResponseTransfer(SellableItemRequestTransfer $sellableItemRequestTransfer): SellableItemResponseTransfer
    {
        return (new SellableItemResponseTransfer())
            ->setSku($sellableItemRequestTransfer->getSkuOrFail())
            ->setProductAvailabilityCriteria($sellableItemRequestTransfer->getProductAvailabilityCriteriaOrFail())
            ->setAvailableQuantity(0)
            ->setIsSellable(false);
    }
}
