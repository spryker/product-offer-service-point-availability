<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferServicePointAvailability\Business\Expander;

use Generated\Shared\Transfer\SellableItemRequestTransfer;
use Generated\Shared\Transfer\SellableItemsResponseTransfer;

interface SellableItemsResponseExpanderInterface
{
    public function expandSellableItemsResponseWithNotSellableItem(
        SellableItemsResponseTransfer $sellableItemsResponseTransfer,
        SellableItemRequestTransfer $sellableItemRequestTransfer
    ): SellableItemsResponseTransfer;
}
