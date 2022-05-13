<?php

namespace BeeDelivery\Acqio\Utils;

use Illuminate\Support\Facades\Validator;

class Helpers
{
    /*
     * Validate data for authorize with CreditCard number.
     *
     * @param array $data
     * @return void
     */
    public function validateWithCardNumber($data)
    {
        $validator = Validator::make($data, [
            'datetime' => 'required|numeric',
            'referenceId' => 'required|string',
            'installments' => 'required|integer',
            'amountE2' => 'required|integer',
            'cardNumber' => 'required|numeric',
            'cardholderName' => 'required|string',
            'cardExpirationDateYymm' => 'required|string|max:4',
            'cvv' => 'required|numeric',
            'autoCapture' => 'required|bool',

            'purchaseInfo' => 'required|array',
            'purchaseInfo.billTo' => 'required|array',
            'purchaseInfo.billTo.address1' => 'required|string',
            'purchaseInfo.billTo.address2' => 'nullable|string',
            'purchaseInfo.billTo.administrativeArea' => 'required|string|max:2',
            'purchaseInfo.billTo.countryCode' => 'required|string|max:2',
            'purchaseInfo.billTo.city' => 'required|string',
            'purchaseInfo.billTo.firstName' => 'required|string',
            'purchaseInfo.billTo.lastName' => 'required|string',
            'purchaseInfo.billTo.phoneNumber' => 'required|numeric',
            'purchaseInfo.billTo.postalCode' => 'required|numeric',

            'purchaseInfo.shippingTo' => 'required|array',
            'purchaseInfo.shippingTo.address1' => 'required|string',
            'purchaseInfo.shippingTo.address2' => 'nullable|string',
            'purchaseInfo.shippingTo.administrativeArea' => 'required|string|max:2',
            'purchaseInfo.shippingTo.countryCode' => 'required|string|max:2',
            'purchaseInfo.shippingTo.city' => 'required|string',
            'purchaseInfo.shippingTo.firstName' => 'required|string',
            'purchaseInfo.shippingTo.lastName' => 'required|string',
            'purchaseInfo.shippingTo.phoneNumber' => 'required|numeric',
            'purchaseInfo.shippingTo.postalCode' => 'required|numeric',

            'purchaseInfo.email' => 'nullable|email',
            'purchaseInfo.ipAddress' => 'nullable|string',
            'purchaseInfo.fingerprintSessionId' => 'nullable|string',
            'purchaseInfo.personalIdentification' => 'nullable|numeric',

        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    /*
     * Validate data for authorize with TokenId number.
     *
     * @param array $data
     * @return void
     */
    public function validateWithTokenId($data)
    {
        $validator = Validator::make($data, [
            'datetime' => 'required|numeric',
            'referenceId' => 'required|string',
            'installments' => 'required|integer',
            'amountE2' => 'required|integer',
            'tokenId' => 'required|string',
            'cardholderName' => 'required|string',
            'cardExpirationDateYymm' => 'required|string|max:4',
            'cvv' => 'required|numeric',
            'autoCapture' => 'required|bool',

            'purchaseInfo' => 'required|array',
            'purchaseInfo.billTo' => 'required|array',
            'purchaseInfo.billTo.address1' => 'required|string',
            'purchaseInfo.billTo.address2' => 'nullable|string',
            'purchaseInfo.billTo.administrativeArea' => 'required|string|max:2',
            'purchaseInfo.billTo.countryCode' => 'required|string|max:2',
            'purchaseInfo.billTo.city' => 'required|string',
            'purchaseInfo.billTo.firstName' => 'required|string',
            'purchaseInfo.billTo.lastName' => 'required|string',
            'purchaseInfo.billTo.phoneNumber' => 'required|numeric',
            'purchaseInfo.billTo.postalCode' => 'required|numeric',

            'purchaseInfo.shippingTo' => 'required|array',
            'purchaseInfo.shippingTo.address1' => 'required|string',
            'purchaseInfo.shippingTo.address2' => 'nullable|string',
            'purchaseInfo.shippingTo.administrativeArea' => 'required|string|max:2',
            'purchaseInfo.shippingTo.countryCode' => 'required|string|max:2',
            'purchaseInfo.shippingTo.city' => 'required|string',
            'purchaseInfo.shippingTo.firstName' => 'required|string',
            'purchaseInfo.shippingTo.lastName' => 'required|string',
            'purchaseInfo.shippingTo.phoneNumber' => 'required|numeric',
            'purchaseInfo.shippingTo.postalCode' => 'required|numeric',

            'purchaseInfo.email' => 'nullable|email',
            'purchaseInfo.ipAddress' => 'nullable|string',
            'purchaseInfo.fingerprintSessionId' => 'nullable|string',
            'purchaseInfo.personalIdentification' => 'nullable|numeric',

        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    /*
     * Validate data for cancel.
     *
     * @param array $data
     * @return void
     */
    public function validateCancel($data)
    {
        $validator = Validator::make($data, [
            'transactionId' => 'required|integer'
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    /*
     * Validate data for cancel by reference.
     *
     * @param array $data
     * @return void
     */
    public function validateCancelByReference($data)
    {
        $validator = Validator::make($data, [
            'reference.datetime' => 'required|string',
            'reference.id' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    /*
     * Validate data for capture.
     *
     * @param array $data
     * @return void
     */
    public function validateCapture($data)
    {
        $validator = Validator::make($data, [
            'transactionId' => 'required|integer'
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }


    /*
     * Validate data for query.
     *
     * @param array $data
     * @return void
     */
    public function validateQuery($data)
    {
        $validator = Validator::make($data, [
            'transactionId' => 'required|integer'
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    /*
     * Validate data for query by reference.
     *
     * @param array $data
     * @return void
     */
    public function validateQueryByReference($data)
    {
        $validator = Validator::make($data, [
            'reference.datetime' => 'required|string',
            'reference.id' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    /*
     * Validate data for query by reference.
     *
     * @param array $data
     * @return void
     */
    public function validateTokenizeCard($data)
    {
        $validator = Validator::make($data, [
            'card_number'   => 'required|numeric',
            'client_id'     => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }
}
