<?php
namespace App\Service\Front;
use App\Repositories\Eloquent\ArticleRepositoryEloquent;
use App\Repositories\Criteria\FilterStatusCriteria;
use App\Repositories\Eloquent\LinkRepositoryEloquent;
use App\Traits\SendSystemErrorTrait;
use Exception;
/**
* 权限service
*/
class IndexService
{
	use SendSystemErrorTrait;
	protected $article;
	protected $link;

	function __construct(ArticleRepositoryEloquent $article,LinkRepositoryEloquent $link)
	{
		$this->article =  $article;
		$this->link  = $link;
	}

	public function getArticleList()
	{
		try {
			$this->article->pushCriteria(new FilterStatusCriteria(config('admin.global.status.active')));
			$articles = $this->article->with('category')->orderBy('created_at', 'desc')->skipPresenter()->paginate(config('admin.global.paginate'));
			return $articles;
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
			return false;
		}
	}


	public function search($q)
	{
		if ($q) {
			try {
				$this->article->pushCriteria(new FilterStatusCriteria(config('admin.global.status.active')));
				$this->article->pushCriteria(new FilterSearchCriteria($q));
				$articles = $this->article->with('category')->orderBy('created_at', 'desc')->skipPresenter()->paginate(config('admin.global.paginate'));
				return compact('articles','q');
			} catch (Exception $e) {
				// 错误信息发送邮件
				$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
				return false;
			}
		}
		return '';
	}

	public function link(){
		try {
			$link = $this->link->skipPresenter()->all();
			return $link;
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
			return false;
		}
	}
}