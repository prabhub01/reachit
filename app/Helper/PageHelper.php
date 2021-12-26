<?php

namespace App\Helper;

use App\Models\AccountType;
use App\Models\Advertisement;
use App\Models\Banner;
use App\Models\Content;
use App\Models\GalleryVideo;
use App\Models\Gallery;
use App\Models\Item;
use App\Models\MenuItems;
use App\Models\News;
use App\Models\Notice;
use App\Models\Popup;
use App\Models\Post;
use App\Models\StockInOutHistory;
use App\Repositories\AdvertisementRepository;
use App\Repositories\MenuRepository;
use Carbon\Carbon;

class PageHelper
{
    protected $menu, $advertisement;

    public function __construct(MenuRepository $menu, AdvertisementRepository $advertisement)
    {
        $this->menu = $menu;
        $this->advertisement = $advertisement;
    }

    protected static function preferredLanguage()
    {
        return Helper::locale();
    }

    public static function visibleIn($page)
    {
        switch ($page) {
            case 'business-banking':
                return ConstantHelper::VISIBLE_IN_BUSINESS;
            case 'trade-finance-treasury':
                return ConstantHelper::VISIBLE_IN_TRADE;
            case 'remittance':
                return ConstantHelper::VISIBLE_IN_REMITTANCE;
            default:
                return ConstantHelper::VISIBLE_IN_PERSONAL;
        }
    }

    public static function banner($page = null)
    {
        $banners = Banner::where('is_active', 1);
        if (!empty($page)) {
            $banners->where(function ($query) use ($page) {
                $query->where('visible_in', 'like', '%' . self::visibleIn($page) . '%')
                    ->orWhere('visible_in', 'like', '%' . ConstantHelper::VISIBLE_IN_BOTH . '%');
            });
        }
        return $banners->orderBy('display_order', 'ASC')->get();
    }

    public static function offer($page = null)
    {
        return Post::where('is_active', 1)->where('language_id', self::preferredLanguage())
            ->where('type', ConstantHelper::POST_TYPE_OFFER)
            ->where(function ($query) use ($page) {
                $query->where('visible_in', 'like', '%' . self::visibleIn($page) . '%')
                    ->orWhere('visible_in', 'like', '%' . ConstantHelper::VISIBLE_IN_BOTH . '%');
            })
            ->orderBy('display_order', 'ASC')->get();
    }

    public static function product($page = null)
    {
        return AccountType::where('is_active', 1)->where('language_id', self::preferredLanguage())
            ->where(function ($query) use ($page) {
                $query->where('visible_in', 'like', '%' . self::visibleIn($page) . '%')
                    ->orWhere('visible_in', 'like', '%' . ConstantHelper::VISIBLE_IN_BOTH . '%');
            })
            ->orderBy('display_order', 'ASC')->get();
    }

    public static function service($page = null)
    {
        return Post::where('is_active', 1)->where('language_id', self::preferredLanguage())
            ->where('type', ConstantHelper::POST_TYPE_SERVICE)
            ->where(function ($query) use ($page) {
                $query->where('visible_in', 'like', '%' . self::visibleIn($page) . '%')
                    ->orWhere('visible_in', 'like', '%' . ConstantHelper::VISIBLE_IN_BOTH . '%');
            })
            ->orderBy('display_order', 'ASC')->get();
    }

    public static function news($page = null, $order = 'desc', $paginate = false, $limit = 12)
    {
        $news = News::where('is_active', 1)->where('language_id', self::preferredLanguage())
            ->where('published_date', '<=', Carbon::now());
        if (!empty($page)) {
            $news->where(function ($query) {
                $query->where('type', 'like', '%' . ConstantHelper::NEWS_TYPE_NEWS . '%')
                    ->orWhere('type', 'like', '%' . ConstantHelper::NEWS_TYPE_BOTH . '%');
            });
        }
        $news->orderBy('published_date', 'desc');
        if ($paginate) {
            return $news->paginate($limit);
        }
        $news->limit($limit);
        return $news->orderBy('display_order', 'ASC')->get();
    }

    public static function popup($page = null)
    {
        if (!empty($page) && !isset($_COOKIE[$page])) {
            setcookie($page, true, time() + (60 * 60), '/');
        } else {
            return false;
        }
        return Popup::where('is_active', 1)->where(function ($query) use ($page) {
            $query->where('visible_in', 'like', '%' . self::visibleIn($page) . '%')
                ->orWhere('visible_in', 'like', '%' . ConstantHelper::VISIBLE_IN_BOTH . '%');
        })->get();
    }

    public static function bannerMenu()
    {
        $layoutMenu = LayoutHelper::layoutMenu(1);
        $bannerItems = [];
        $bannerMenu = LayoutHelper::bannerMenu($layoutMenu, 'banner-menu');
        if ($bannerMenu) {
            $menu = MenuItems::where('menu_id', $bannerMenu)
                ->where('language_id', Helper::locale())
                ->where('parent_id', null)
                ->orderBy('parent_id', 'asc')
                ->orderBy('display_order', 'asc')->get();
            foreach ($menu as $data) {
                $bannerItems['parent'][$data->id]['id'] = $data->id;
                $bannerItems['parent'][$data->id]['title'] = $data->title;
                $bannerItems['parent'][$data->id]['slug'] = $data->slug;
                $bannerItems['parent'][$data->id]['url'] = url($data->link_url);
                $bannerItems['parent'][$data->id]['relative_url'] = $data->link_url;
                $bannerItems['parent'][$data->id]['target'] = $data->link_target == true ? 'target="_blank"' : '';
                $bannerItems['parent'][$data->id]['icon'] = isset($data->icon) && !empty($data->icon) ? $data->icon : '';
            }
        }
        return $bannerItems;
    }

    public static function advertisements($page = null, $placement = null)
    {
        $ads = [];

        if (!empty($page) && !empty($placement)) {
            $advertisements = Advertisement::where('is_active', 1);
            if (!empty($page) && self::adsVisibleIn($page) != false) {
                $advertisements = $advertisements->where('visible_in', 'like', '%' . self::adsVisibleIn($page) . '%');
            }
            if (!empty($placement)) {
                $advertisements = $advertisements->where('placement_id', $placement);
            }
            // $advertisements = $advertisements->orWhere('visible_in', 'like', '%' . ConstantHelper::AD_VISIBLE_IN_ALL . '%');
            $advertisements = $advertisements->get();
            if ($advertisements) {
                foreach ($advertisements as $advertisement) {
                    $ads[$advertisement->id]['image'] = $advertisement->image;
                    $ads[$advertisement->id]['link'] = $advertisement->link;
                }
            }
        }
        return $ads;
    }

    public static function adsVisibleIn($page)
    {
        switch ($page) {
            case 'business-banking':
                return ConstantHelper::AD_VISIBLE_IN_BUSINESS;
            case 'trade-finance-treasury':
                return ConstantHelper::AD_VISIBLE_IN_TRADE;
            case 'remittance':
                return ConstantHelper::AD_VISIBLE_IN_REMITTANCE;
            case 'news':
                return ConstantHelper::AD_VISIBLE_IN_NEWS;
            case 'csr':
                return ConstantHelper::AD_VISIBLE_IN_CSR;
            case 'content':
                return ConstantHelper::AD_VISIBLE_IN_CONTENT;
            case 'personal-banking':
                return ConstantHelper::AD_VISIBLE_IN_PERSONAL;
            default:
                return false;
        }
    }

    public static function asideMenu($content)
    {
        $items = [];
        $menuItem = MenuItems::where('slug', $content->slug)
            ->where('language_id', Helper::locale())
            ->orderBy('display_order', 'asc')
            ->first();
        if ($menuItem) {
            $itemList = MenuItems::where('parent_id', $menuItem->parent_id)
                ->where('language_id', Helper::locale())
                ->where('is_active', 1)
                ->orderBy('display_order', 'asc')->get();
            if ($itemList) {
                foreach ($itemList as $data) {
                    $items[$data->id]['id'] = $data->id;
                    $items[$data->id]['title'] = $data->title;
                    $items[$data->id]['slug'] = $data->slug;
                    $items[$data->id]['url'] = url($data->link_url);
                    $items[$data->id]['relative_url'] = $data->link_url;
                    $items[$data->id]['target'] = $data->link_target == true ? 'target="_blank"' : '';
                    $items[$data->id]['icon'] = isset($data->icon) && !empty($data->icon) ? $data->icon : '';
                }
            }
        }
        return $items;
    }

    public static function contentHierarchy($content)
    {
        $items = [];
        $parentId = $content->parent_id != null && !empty($content->parent_id) ? $content->parent_id : $content->id;

        $contentList = Content::where('parent_id', $parentId)
            ->where('language_id', Helper::locale())
            ->where('is_active', 1)
            ->orderBy('display_order', 'asc')->get();

        if ($contentList) {
            foreach ($contentList as $data) {
                $items[$data->id]['id'] = $data->id;
                $items[$data->id]['title'] = $data->title;
                $items[$data->id]['slug'] = $data->slug;
                $items[$data->id]['url'] = !empty($data->link) ? $data->link : url($data->slug);
                $items[$data->id]['relative_url'] = $data->slug;
                $items[$data->id]['target'] = $data->link_target == true ? 'target="_blank"' : '';
            }
        }

        return $items;
    }

    public static function notification()
    {
        $notification = [];
        $notification['count'] = 0;

        $list = News::where('show_in_notification', 1)->where('language_id', Helper::locale())
            ->where('is_active', 1)
            ->orderBy('display_order', 'asc')
            ->limit(4)
            ->get();

        if ($list) {
            $notification['count'] = count($list);
            foreach ($list as $item) {
                $visibleIn = explode(',', $item->type);
                $url = $visibleIn[0] == ConstantHelper::NEWS_TYPE_CSR ? url("/csr/{$item->slug}") : url("/news/{$item->slug}");
                $notification['item'][$item->title] = $url;
            }
        }

        $offer = Post::where('show_in_notification', 1)->where('language_id', Helper::locale())
            ->where('is_active', 1)
            ->orderBy('display_order', 'asc')
            ->limit(4)
            ->get();

        if ($offer) {
            $notification['count'] = $notification['count'] + count($offer);

            foreach ($offer as $item) {
                $url = url("/offers/{$item->slug}");
                $notification['item'][$item->title] = $url;
            }
        }
        return $notification;
    }

    public static function videos()
    {
        return GalleryVideo::where('is_active', 1)->orderBy('display_order', 'asc')->limit(1)->get();
    }

    public static function pressReleases($paginate = false, $limit = 2)
    {
        $notice = Notice::where('type', ConstantHelper::NOTICE_TYPE_PRESS_RELEASE)->where('is_active', 1)->orderBy('display_order', 'asc');
        if ($paginate) {
            return $notice->paginate($limit);
        }
        return $notice->limit($limit)->get();
    }

    public static function galleries()
    {
        return Gallery::where('is_active', 1)->orderBy('display_order', 'asc')->limit(5)->get();
    }

    public static function successStories($paginate = false, $limit = 3)
    {
        $parent = Content::where('slug', 'success-stories')->first();
        if ($parent) {
            $child = Content::where('parent_id', $parent->id)->where('is_active', 1);
            if ($paginate) {
                return $child->paginate($limit);
            }
            return $child->limit($limit)->get();
        }
    }


    public static function allChildContent($id, $paginate = false, $limit = 12)
    {
        $content = Content::where('parent_id', $id)->with('child');
        $content->orderBy('display_order', 'asc');
        if ($paginate) {
            return $content->paginate($limit);
        }
        return $content->limit($limit)->get();
    }

    public static function finishProducts($ids)
    {
        if (isset($ids) && !empty($ids)) {
            $itemIds = explode(',', $ids);
            $data = Item::whereIn('id', $itemIds)->get();
            return $data;
        }
        return null;
    }


    public static function checkFinishProduct($parent_id, $employee_id, $item_id)
    {
        if (!empty($parent_id) && !empty($employee_id) && !empty($item_id)) {
            $data = StockInOutHistory::where('parent_id', $parent_id)->where('item_id', $item_id)->where('employee_id', $employee_id)->where('is_wastage', 'no')->first();
            return $data;
        }
        return null;
    }

    public static function breadcrumb($title)
    {
        dd(session()->get('menuItems'));
    }
}
