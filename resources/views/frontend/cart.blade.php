@extends('layouts.app')

@section('content')
<div class="main__body__wrapp">
    <div class="what__you__wrapp">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 col-xxl-8 pe-lg-4">
                    <div class="table-responsive">
                        <table class="table cart-data-table">
                            <thead>
                                <tr class="bg--primary">
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="cart-data-table__row">
                                    <td>
                                        <a href="#" class="d-flex align-items-center cart-data-table__product">
                                            <span class="cart-data-table__product-image me-3">
                                                <img src="assets/images/1565838_e54e_16.jpg" alt="product1" />
                                            </span>
                                            <span class="cart-data-table__product-title">Product 1</span>
                                        </a>
                                    </td>
                                    <td class="text--heading fw-bold">$120.00</td>
                                    <td>
                                        <div class="quantity-generating-input-container">
                                            <input type="button" value="-" class="qtyminus" field="quantity1" />
                                            <input type="text" name="quantity1" value="1" class="qty" />
                                            <input type="button" value="+" class="qtyplus" field="quantity1" />
                                        </div>
                                    </td>
                                    <td class="text--heading fw-bold">$120.00</td>
                                    <td>
                                        <a href="javascript:void(0)" class="cart-data-table__button--remove-row"><i class="bi bi-x-lg"></i></a>
                                    </td>
                                </tr>
                                <tr class="cart-data-table__row">
                                    <td>
                                        <a href="#" class="d-flex align-items-center cart-data-table__product">
                                            <span class="cart-data-table__product-image me-3">
                                                <img src="assets/images/1565838_e54e_16.jpg" alt="product1" />
                                            </span>
                                            <span class="cart-data-table__product-title">Product 1</span>
                                        </a>
                                    </td>
                                    <td class="text--heading fw-bold">$120.00</td>
                                    <td>
                                        <div class="quantity-generating-input-container">
                                            <input type="button" value="-" class="qtyminus" field="quantity1" />
                                            <input type="text" name="quantity1" value="1" class="qty" />
                                            <input type="button" value="+" class="qtyplus" field="quantity1" />
                                        </div>
                                    </td>
                                    <td class="text--heading fw-bold">$120.00</td>
                                    <td>
                                        <a href="javascript:void(0)" class="cart-data-table__button--remove-row"><i class="bi bi-x-lg"></i></a>
                                    </td>
                                </tr>
                                <tr class="cart-data-table__row">
                                    <td>
                                        <a href="#" class="d-flex align-items-center cart-data-table__product">
                                            <span class="cart-data-table__product-image me-3">
                                                <img src="assets/images/1565838_e54e_16.jpg" alt="product1" />
                                            </span>
                                            <span class="cart-data-table__product-title">Product 1</span>
                                        </a>
                                    </td>
                                    <td class="text--heading fw-bold">$120.00</td>
                                    <td>
                                        <div class="quantity-generating-input-container">
                                            <input type="button" value="-" class="qtyminus" field="quantity1" />
                                            <input type="text" name="quantity1" value="1" class="qty" />
                                            <input type="button" value="+" class="qtyplus" field="quantity1" />
                                        </div>
                                    </td>
                                    <td class="text--heading fw-bold">$120.00</td>
                                    <td>
                                        <a href="javascript:void(0)" class="cart-data-table__button--remove-row"><i class="bi bi-x-lg"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="empty-cart-text text-center d-none error-text mt-3">
                        No item has been added to the cart.
                    </p>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="#" class="button button-primary con">Continue Shopping</a>
                        <a href="javascript:void(0)" class="cart-data-table__button--clear-total-items ms-3 text-uppercase">
                            <span><i class="bi bi-x-lg"></i></span>
                            <span>Clear</span>
                        </a>
                    </div>

                    <div class="checkout-steps mx-4 mx-sm-0 d-none">
                        <div class="checkout-step__content mt-4">
                            <div class="address-container">
                                <ul class="address-saved-list row">
                                    <li class="address-saved-list__item col-12 col-sm-6 col-xl-4 selected">
                                        <div class="p-4 bg--light border-radius--custom border-custom-1">
                                            <p class="text--xs text--primary m-0 p-2">
                                                1/30 Lorem Street, Kolkata-5050, Near Lorem Shop
                                            </p>
                                            <a href="javascript:void(0)" class="address-saved-list__item--select-btn"><i class="bi bi-check-circle-fill"></i></a>
                                        </div>
                                    </li>
                                    <li class="address-saved-list__item col-12 col-sm-6 col-xl-4">
                                        <div class="p-4 bg--light border-radius--custom border-custom-1">
                                            <p class="text--xs text--primary m-0 p-2">
                                                1/30 Lorem Street, Kolkata-5050, Near Lorem Shop
                                            </p>
                                            <a href="javascript:void(0)" class="address-saved-list__item--select-btn"><i class="bi bi-check-circle-fill"></i></a>
                                        </div>
                                    </li>
                                    <div class="col-12 col-sm-6 col-xl-4 mt-3 mt-sm-0 text-center text-sm-start">
                                        <a class="button button-primary d-inline-block w-auto address-container__button--add-adress" data-bs-toggle="offcanvas" href="#addAddressOffCanvas" role="button" aria-controls="offcanvasExample">Add Address<span class="ms-1"><i class="bi bi-plus"></i></span></a>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-4 col-xxl-4 mt-5 mt-lg-0">
                    <div class="cart-total-wrapper order-summary bg--light border-custom-1 border-radius--custom p-4">
                        <h5 class="text--heading order-summary__heading mb-3">
                            Order Summary
                        </h5>
                        <ul class="order-summary__product-preview-container mt-1">
                            <li class="product-preview row">
                                <div class="col-7 p-0">
                                    <p class="text--primary text--sm">
                                        <span class="product-preview__title">Product Title 1</span>
                                        <span class="product-preview__added-count-value text--para">x 2</span>
                                    </p>
                                </div>
                                <div class="col-5 text-end p-0">
                                    <h6 class="m-0">$20.00</h6>
                                </div>
                            </li>
                            <li class="product-preview row">
                                <div class="col-7 p-0">
                                    <p class="text--primary text--sm">
                                        <span class="product-preview__title">Product Title 1</span>
                                        <span class="product-preview__added-count-value text--para">x 2</span>
                                    </p>
                                </div>
                                <div class="col-5 text-end p-0">
                                    <h6 class="m-0">$20.00</h6>
                                </div>
                            </li>
                        </ul>
                        <div class="cart__subtotal-container d-flex justify-content-between align-items-center mb-3">
                            <p class="text--sm text--primary m-0 fw-bold">Subtotal</p>
                            <h6 class="-0">$20.00</h6>
                        </div>
                        <div class="cart__subtotal-container d-flex justify-content-between align-items-center mb-3">
                            <p class="text--sm text--primary m-0 fw-bold">GST</p>
                            <h6 class="m-0">$10.00</h6>
                        </div>
                        <div class="cart__subtotal-container cart__subtotal-container--shipping d-flex justify-content-between align-items-center mb-3">
                            <p class="text--sm text--primary m-0 fw-bold">
                                Shipping Charge
                            </p>
                            <h6 class="m-0">
                                <span class="shipping-charge__prefix text--sm text--primary me-1">Flat
                                    rate</span><span class="shipping-charge__value">$5.00</span>
                            </h6>
                        </div>

                        <div class="cart__total-container d-flex justify-content-between align-items-center mb-0">
                            <p class="text--lg text--primary m-0 fw-bold">Total</p>
                            <h5 class="text--heading m-0">$35.00</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop