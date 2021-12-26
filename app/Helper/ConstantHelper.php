<?php

namespace App\Helper;

class ConstantHelper
{
    const DEFAULT_PAGE_SIZE = 10;
    
    const SHOW_ATTRIBUTE = 1;
    const DEFAULT_DATE_FORMAT = 7;
    const DEFAULT_LANGUAGE = 1;

    const IS_ACTIVE = 1;

    const POST_TYPE_ASSOCIATE = 1;
    const POST_TYPE_SERVICE = 2;
    const POST_TYPE_OFFER = 3;
    const POST_TYPE_PARTNER = 4;
    const POST_TYPE_REMITTANCE_ALLIANCE = 5;
    const POST_TYPE_REMITTANCE_INFO = 6;

    const NOTICE_TYPE_NOTICE = 1;
    const NOTICE_TYPE_TENDER = 2;
    const NOTICE_TYPE_PRESS_RELEASE = 3;

    const VISIBLE_IN_PERSONAL = 1;
    const VISIBLE_IN_BUSINESS = 2;
    const VISIBLE_IN_BOTH = 3;
    const VISIBLE_IN_TRADE = 5;
    const VISIBLE_IN_REMITTANCE = 4;

    const VISIBLE_IN_REMITTANCE_LOCAL = 1;
    const VISIBLE_IN_REMITTANCE_OVERSEAS = 2;
    const VISIBLE_IN_REMITTANCE_KUMARI = 3;

    const MENU_TYPE_CONTENT = 1;
    const MENU_TYPE_CUSTOM = 2;

    const NEWS_TYPE_NEWS = 1;
    const NEWS_TYPE_CSR = 2;
    const NEWS_TYPE_BOTH = 3;

    const GRIEVENCE_CODE = 'GRID';
    const APPLICANT_PREFIX = 'AID';

    const AD_VISIBLE_IN_PERSONAL = 1;
    const AD_VISIBLE_IN_BUSINESS = 2;
    const AD_VISIBLE_IN_TRADE = 3;
    const AD_VISIBLE_IN_REMITTANCE = 4;
    const AD_VISIBLE_IN_REMITTANCE_LOCAL = 5;
    const AD_VISIBLE_IN_REMITTANCE_OVERSEAS = 6;
    const AD_VISIBLE_IN_REMITTANCE_KUMARI = 7;
    const AD_VISIBLE_IN_NEWS = 8;
    const AD_VISIBLE_IN_CSR = 9;
    const AD_VISIBLE_IN_CONTENT = 10;
    const AD_VISIBLE_IN_ALL = 11;

    const IS_FEATURED = 1;
}
