<?php

namespace app\controllers;

use Yii;
use app\models\Vote;
use app\models\User;
use app\models\Candidate;
use app\models\Position;
use GuzzleHttp\Psr7\Request;
use PhpParser\Builder\Function_;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\helpers\Json;

class VoteController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'vote' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = '/dashb.php';

        $positions = Position::find()->all();

        // $candidates = Candidate::find()->where(['position_id' => $position])->all();

        // Display the voting form
        return $this->render('index', [
            'positions' => $positions,
            // 'candidates' => $candidates,
        ]);
    }


    public function actionVote()
    {
        // Check if at least one candidate is selected
        if (empty($_POST['candidate_id'])) {
            Yii::$app->session->setFlash('error', 'You must select at least one candidate to cast vote.');
            return $this->redirect(['vote/index']);
        }

        // Get the currently logged in voter
        $voter = Yii::$app->user->identity;

        // Loop through each position and save the vote
        foreach ($_POST['candidate_id'] as $position_id => $candidate_id) {

            // Check if the voter has already voted for this position
            $hasVoted = Vote::find()->where([
                'voter_id' => $voter->id,
                'position_id' => $position_id
            ])->exists();

            if (!$hasVoted) {
                // Create a new vote record
                $vote = new Vote();
                $vote->voter_id = $voter->id;
                $vote->candidate_id = $candidate_id;
                $vote->position_id = $position_id;
                $vote->save();

                // Display a success message
                Yii::$app->session->setFlash('success', 'Vote casted successfully!');
            } else {
                // Display an error message
                Yii::$app->session->setFlash('error', 'You have already voted for this position.');
            }
        }

        // Redirect to the voting page
        return $this->redirect(['vote/index']);
    }

    public function actionBio($slug)
    {
        $this->layout = '/dashb.php';

        $model = Candidate::findOne(['slug' => $slug]);

        return $this->render('bio', [
            'model' => $model,
        ]);
    }


    public function actionResult()
    {
        $this->layout = '/dashb.php';

        $positions = Position::find()->all();

        $results = [];
        foreach ($positions as $position) {
            $votes = Vote::find()
                ->select(['candidate_id', 'COUNT(*) as total_votes'])
                ->where(['position_id' => $position->id])
                ->groupBy('candidate_id')
                ->orderBy(['total_votes' => SORT_DESC])
                ->asArray()
                ->all();

            // Add candidates with no votes to the results array with 0 votes
            $allCandidates = Candidate::find()->select(['id'])->where(['position_id' => $position->id])->asArray()->all();
            $candidateIdsWithVotes = array_column($votes, 'candidate_id');
            $candidatesWithoutVotes = array_diff(array_column($allCandidates, 'id'), $candidateIdsWithVotes);
            foreach ($candidatesWithoutVotes as $candidateId) {
                $votes[] = ['candidate_id' => $candidateId, 'total_votes' => 0];
            }

            $results[$position->id] = $votes;
        }

        // Display the election results
        return $this->render('result', [
            'results' => $results,
            'positions' => $positions,
        ]);
    }
}
