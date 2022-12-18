# tyler-card-app

To run app:

Step 1: 
docker-compose up 

Step 2: 
docker-compose exec app composer update

Step 3:
npm install

Step 4:
npx mix

Navigation:
=================
	- app url: http://localhost:8080
	- phpmyadmin url: http//localhost:3306

DB Credentials:
================
	- username: yii2advanced
	- password: secret

Query Optimisation:
=============================================================================================================

1. There is two ways of optimizing LIKE statement
	- full-text-search: which is not 100% accurate but improves searches because of the use of indexing
	- UNION: separate tables into using UNION
2. Indexing relevant primary key, foreign key, and keys that is use for searching
3. Avoid using IS NULL/ IS NOT NULL as a condition/filter. Eg. Personalities.deleted IS NULL is changed to Personalities.status = 1



Example 1: BY UNION
============================================================================================================

-- START --

	SELECT 
	`Jobs__id`,
	`Jobs__name`,
	`Jobs__media_id`,
	GROUP_CONCAT(`Jobs__job_category_id`) AS `Jobs__job_category_id`,
	GROUP_CONCAT(`Jobs__job_type_id`) AS `Jobs__job_type_id`,
	`Jobs__description`,
	`Jobs__detail`,
	`Jobs__business_skill`,
	`Jobs__knowledge`,
	`Jobs__location`,
	`Jobs__activity`,
	`Jobs__academic_degree_doctor`,
	`Jobs__academic_degree_master`,
	`Jobs__academic_degree_professional`,
	`Jobs__academic_degree_bachelor`,
	`Jobs__salary_statistic_group`,
	`Jobs__salary_range_first_year`,
	`Jobs__salary_range_average`,
	`Jobs__salary_range_remarks`,
	`Jobs__restriction`,
	`Jobs__estimated_total_workers`,
	`Jobs__remarks`,
	`Jobs__url`,
	`Jobs__seo_description`,
	`Jobs__seo_keywords`,
	`Jobs__sort_order`,
	`Jobs__publish_status`,
	`Jobs__version`,
	`Jobs__created_by`,
	`Jobs__created`,
	`Jobs__modified`,
	`Jobs__deleted`,
	GROUP_CONCAT(`JobCategories__id`) AS `JobCategories__id`,
	GROUP_CONCAT(`JobCategories__name`) AS `JobCategories__name`,
	GROUP_CONCAT(`JobCategories__sort_order`) AS `JobCategories__sort_order`,
	GROUP_CONCAT(`JobCategories__created_by`) AS `JobCategories__created_by`,
	GROUP_CONCAT(`JobCategories__created`) AS `JobCategories__created`,
	GROUP_CONCAT(`JobCategories__modified`) AS `JobCategories__modified`,
	GROUP_CONCAT(`JobCategories__deleted`) AS `JobCategories__deleted`,
	GROUP_CONCAT(`JobTypes__id`) AS `JobTypes__id`,
	GROUP_CONCAT(`JobTypes__name`) AS `JobTypes__name`,
	GROUP_CONCAT(`JobTypes__job_category_id`) AS `JobTypes__job_category_id`,
	GROUP_CONCAT(`JobTypes__sort_order`) AS `JobTypes__sort_order`,
	GROUP_CONCAT(`JobTypes__created_by`) AS `JobTypes__created_by`,
	GROUP_CONCAT(`JobTypes__created`) AS `JobTypes__created`,
	GROUP_CONCAT(`JobTypes__modified`) AS `JobTypes__modified`,
	GROUP_CONCAT(`JobTypes__deleted`) AS `JobTypes__deleted`
	FROM 
	(
		SELECT 
			Jobs.id AS `Jobs__id`,
			Jobs.name AS `Jobs__name`,
			Jobs.media_id AS `Jobs__media_id`,
			'' AS `Jobs__job_category_id`,
			'' AS `Jobs__job_type_id`,
			Jobs.description AS `Jobs__description`,
			Jobs.detail AS `Jobs__detail`,
			Jobs.business_skill AS `Jobs__business_skill`,
			Jobs.knowledge AS `Jobs__knowledge`,
			Jobs.location AS `Jobs__location`,
			Jobs.activity AS `Jobs__activity`,
			Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
			Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
			Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
			Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
			Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
			Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
			Jobs.salary_range_average AS `Jobs__salary_range_average`,
			Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
			Jobs.restriction AS `Jobs__restriction`,
			Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
			Jobs.remarks AS `Jobs__remarks`,
			Jobs.url AS `Jobs__url`,
			Jobs.seo_description AS `Jobs__seo_description`,
			Jobs.seo_keywords AS `Jobs__seo_keywords`,
			Jobs.sort_order AS `Jobs__sort_order`,
			Jobs.publish_status AS `Jobs__publish_status`,
			Jobs.version AS `Jobs__version`,
			Jobs.created_by AS `Jobs__created_by`,
			Jobs.created AS `Jobs__created`,
			Jobs.modified AS `Jobs__modified`,
			Jobs.deleted AS `Jobs__deleted`,
			'' AS `JobCategories__id`,
			'' AS `JobCategories__name`,
			'' AS `JobCategories__sort_order`,
			'' AS `JobCategories__created_by`,
			'' AS `JobCategories__created`,
			'' AS `JobCategories__modified`,
			'' AS `JobCategories__deleted`,
			'' AS `JobTypes__id`,
			'' AS `JobTypes__name`,
			'' AS `JobTypes__job_category_id`,
			'' AS `JobTypes__sort_order`,
			'' AS `JobTypes__created_by`,
			'' AS `JobTypes__created`,
			'' AS `JobTypes__modified`,
			'' AS `JobTypes__deleted`
		FROM jobs Jobs
		WHERE (
			(
				Jobs.name LIKE '%キャビンアテンダント%'
				OR Jobs.description LIKE '%キャビンアテンダント%'
				OR Jobs.detail LIKE '%キャビンアテンダント%'
				OR Jobs.business_skill LIKE '%キャビンアテンダント%'
				OR Jobs.knowledge LIKE '%キャビンアテンダント%'
				OR Jobs.location LIKE '%キャビンアテンダント%'
				OR Jobs.activity LIKE '%キャビンアテンダント%'
				OR Jobs.salary_statistic_group LIKE '%キャビンアテンダント%'
				OR Jobs.salary_range_remarks LIKE '%キャビンアテンダント%'
				OR Jobs.restriction LIKE '%キャビンアテンダント%'
				OR Jobs.remarks LIKE '%キャビンアテンダント%'
			) 
			AND Jobs.publish_status = 1
			AND Jobs.status = 0)

		UNION ALL 

		SELECT 
			Jobs.id AS `Jobs__id`,
			Jobs.name AS `Jobs__name`,
			Jobs.media_id AS `Jobs__media_id`,
			Jobs.job_category_id AS `Jobs__job_category_id`,
			'' AS `Jobs__job_type_id`,
			Jobs.description AS `Jobs__description`,
			Jobs.detail AS `Jobs__detail`,
			Jobs.business_skill AS `Jobs__business_skill`,
			Jobs.knowledge AS `Jobs__knowledge`,
			Jobs.location AS `Jobs__location`,
			Jobs.activity AS `Jobs__activity`,
			Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
			Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
			Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
			Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
			Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
			Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
			Jobs.salary_range_average AS `Jobs__salary_range_average`,
			Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
			Jobs.restriction AS `Jobs__restriction`,
			Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
			Jobs.remarks AS `Jobs__remarks`,
			Jobs.url AS `Jobs__url`,
			Jobs.seo_description AS `Jobs__seo_description`,
			Jobs.seo_keywords AS `Jobs__seo_keywords`,
			Jobs.sort_order AS `Jobs__sort_order`,
			Jobs.publish_status AS `Jobs__publish_status`,
			Jobs.version AS `Jobs__version`,
			Jobs.created_by AS `Jobs__created_by`,
			Jobs.created AS `Jobs__created`,
			Jobs.modified AS `Jobs__modified`,
			Jobs.deleted AS `Jobs__deleted`,
			JobCategories.id AS `JobCategories__id`,
			JobCategories.name AS `JobCategories__name`,
			JobCategories.sort_order AS `JobCategories__sort_order`,
			JobCategories.created_by AS `JobCategories__created_by`,
			JobCategories.created AS `JobCategories__created`,
			JobCategories.modified AS `JobCategories__modified`,
			JobCategories.deleted AS `JobCategories__deleted`,
			'' AS `JobTypes__id`,
			'' AS `JobTypes__name`,
			'' AS `JobTypes__job_category_id`,
			'' AS `JobTypes__sort_order`,
			'' AS `JobTypes__created_by`,
			'' AS `JobTypes__created`,
			'' AS `JobTypes__modified`,
			'' AS `JobTypes__deleted`
		FROM jobs Jobs
		INNER JOIN job_categories JobCategories ON (JobCategories.id = (Jobs.job_category_id) AND (JobCategories.status = 1))
		WHERE (
			JobCategories.name LIKE '%キャビンアテンダント%'
			AND Jobs.publish_status = 1
			AND Jobs.status = 1)

		UNION ALL

		SELECT 
			Jobs.id AS `Jobs__id`,
			Jobs.name AS `Jobs__name`,
			Jobs.media_id AS `Jobs__media_id`,
			Jobs.job_category_id AS `Jobs__job_category_id`,
			Jobs.job_type_id AS `Jobs__job_type_id`,
			Jobs.description AS `Jobs__description`,
			Jobs.detail AS `Jobs__detail`,
			Jobs.business_skill AS `Jobs__business_skill`,
			Jobs.knowledge AS `Jobs__knowledge`,
			Jobs.location AS `Jobs__location`,
			Jobs.activity AS `Jobs__activity`,
			Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
			Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
			Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
			Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
			Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
			Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
			Jobs.salary_range_average AS `Jobs__salary_range_average`,
			Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
			Jobs.restriction AS `Jobs__restriction`,
			Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
			Jobs.remarks AS `Jobs__remarks`,
			Jobs.url AS `Jobs__url`,
			Jobs.seo_description AS `Jobs__seo_description`,
			Jobs.seo_keywords AS `Jobs__seo_keywords`,
			Jobs.sort_order AS `Jobs__sort_order`,
			Jobs.publish_status AS `Jobs__publish_status`,
			Jobs.version AS `Jobs__version`,
			Jobs.created_by AS `Jobs__created_by`,
			Jobs.created AS `Jobs__created`,
			Jobs.modified AS `Jobs__modified`,
			Jobs.deleted AS `Jobs__deleted`,
			'' AS `JobCategories__id`,
			'' AS `JobCategories__name`,
			'' AS `JobCategories__sort_order`,
			'' AS `JobCategories__created_by`,
			'' AS `JobCategories__created`,
			'' AS `JobCategories__modified`,
			'' AS `JobCategories__deleted`,
			JobTypes.id AS `JobTypes__id`,
			JobTypes.name AS `JobTypes__name`,
			JobTypes.job_category_id AS `JobTypes__job_category_id`,
			JobTypes.sort_order AS `JobTypes__sort_order`,
			JobTypes.created_by AS `JobTypes__created_by`,
			JobTypes.created AS `JobTypes__created`,
			JobTypes.modified AS `JobTypes__modified`,
			JobTypes.deleted AS `JobTypes__deleted`
		FROM jobs Jobs
		INNER JOIN job_types JobTypes ON (JobTypes.id = (Jobs.job_type_id) AND (JobTypes.status = 1))
		WHERE (
			JobTypes.name LIKE '%キャビンアテンダント%'	
			AND Jobs.publish_status = 1
			AND Jobs.status = 1)

		UNION ALL

		SELECT 
			Jobs.id AS `Jobs__id`,
			Jobs.name AS `Jobs__name`,
			Jobs.media_id AS `Jobs__media_id`,
			'' AS `Jobs__job_category_id`,
			'' AS `Jobs__job_type_id`,
			Jobs.description AS `Jobs__description`,
			Jobs.detail AS `Jobs__detail`,
			Jobs.business_skill AS `Jobs__business_skill`,
			Jobs.knowledge AS `Jobs__knowledge`,
			Jobs.location AS `Jobs__location`,
			Jobs.activity AS `Jobs__activity`,
			Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
			Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
			Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
			Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
			Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
			Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
			Jobs.salary_range_average AS `Jobs__salary_range_average`,
			Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
			Jobs.restriction AS `Jobs__restriction`,
			Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
			Jobs.remarks AS `Jobs__remarks`,
			Jobs.url AS `Jobs__url`,
			Jobs.seo_description AS `Jobs__seo_description`,
			Jobs.seo_keywords AS `Jobs__seo_keywords`,
			Jobs.sort_order AS `Jobs__sort_order`,
			Jobs.publish_status AS `Jobs__publish_status`,
			Jobs.version AS `Jobs__version`,
			Jobs.created_by AS `Jobs__created_by`,
			Jobs.created AS `Jobs__created`,
			Jobs.modified AS `Jobs__modified`,
			Jobs.deleted AS `Jobs__deleted`,
			'' AS `JobCategories__id`,
			'' AS `JobCategories__name`,
			'' AS `JobCategories__sort_order`,
			'' AS `JobCategories__created_by`,
			'' AS `JobCategories__created`,
			'' AS `JobCategories__modified`,
			'' AS `JobCategories__deleted`,
			'' AS `JobTypes__id`,
			'' AS `JobTypes__name`,
			'' AS `JobTypes__job_category_id`,
			'' AS `JobTypes__sort_order`,
			'' AS `JobTypes__created_by`,
			'' AS `JobTypes__created`,
			'' AS `JobTypes__modified`,
			'' AS `JobTypes__deleted`
			
		FROM jobs Jobs
		INNER JOIN jobs_personalities JobsPersonalities ON Jobs.id = (JobsPersonalities.job_id)
		INNER JOIN personalities Personalities ON (Personalities.id = (JobsPersonalities.personality_id) AND (Personalities.status = 1)) 
		WHERE (
			Personalities.name LIKE '%キャビンアテンダント%'
			AND Jobs.publish_status = 1
			AND Jobs.status = 1)

		UNION ALL

		SELECT 
			Jobs.id AS `Jobs__id`,
			Jobs.name AS `Jobs__name`,
			Jobs.media_id AS `Jobs__media_id`,
			'' AS `Jobs__job_category_id`,
			'' AS `Jobs__job_type_id`,
			Jobs.description AS `Jobs__description`,
			Jobs.detail AS `Jobs__detail`,
			Jobs.business_skill AS `Jobs__business_skill`,
			Jobs.knowledge AS `Jobs__knowledge`,
			Jobs.location AS `Jobs__location`,
			Jobs.activity AS `Jobs__activity`,
			Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
			Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
			Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
			Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
			Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
			Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
			Jobs.salary_range_average AS `Jobs__salary_range_average`,
			Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
			Jobs.restriction AS `Jobs__restriction`,
			Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
			Jobs.remarks AS `Jobs__remarks`,
			Jobs.url AS `Jobs__url`,
			Jobs.seo_description AS `Jobs__seo_description`,
			Jobs.seo_keywords AS `Jobs__seo_keywords`,
			Jobs.sort_order AS `Jobs__sort_order`,
			Jobs.publish_status AS `Jobs__publish_status`,
			Jobs.version AS `Jobs__version`,
			Jobs.created_by AS `Jobs__created_by`,
			Jobs.created AS `Jobs__created`,
			Jobs.modified AS `Jobs__modified`,
			Jobs.deleted AS `Jobs__deleted`,
			'' AS `JobCategories__id`,
			'' AS `JobCategories__name`,
			'' AS `JobCategories__sort_order`,
			'' AS `JobCategories__created_by`,
			'' AS `JobCategories__created`,
			'' AS `JobCategories__modified`,
			'' AS `JobCategories__deleted`,
			'' AS `JobTypes__id`,
			'' AS `JobTypes__name`,
			'' AS `JobTypes__job_category_id`,
			'' AS `JobTypes__sort_order`,
			'' AS `JobTypes__created_by`,
			'' AS `JobTypes__created`,
			'' AS `JobTypes__modified`,
			'' AS `JobTypes__deleted`
		FROM jobs Jobs
		LEFT JOIN jobs_practical_skills JobsPracticalSkills ON Jobs.id = (JobsPracticalSkills.job_id)
		LEFT JOIN practical_skills PracticalSkills ON (PracticalSkills.id = (JobsPracticalSkills.practical_skill_id) AND (PracticalSkills.status = 1))
		WHERE (
			PracticalSkills.name LIKE '%キャビンアテンダント%'
			AND Jobs.publish_status = 1
			AND Jobs.status = 1)

		UNION ALL 

		SELECT 
			Jobs.id AS `Jobs__id`,
			Jobs.name AS `Jobs__name`,
			Jobs.media_id AS `Jobs__media_id`,
			'' AS `Jobs__job_category_id`,
			'' AS `Jobs__job_type_id`,
			Jobs.description AS `Jobs__description`,
			Jobs.detail AS `Jobs__detail`,
			Jobs.business_skill AS `Jobs__business_skill`,
			Jobs.knowledge AS `Jobs__knowledge`,
			Jobs.location AS `Jobs__location`,
			Jobs.activity AS `Jobs__activity`,
			Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
			Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
			Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
			Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
			Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
			Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
			Jobs.salary_range_average AS `Jobs__salary_range_average`,
			Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
			Jobs.restriction AS `Jobs__restriction`,
			Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
			Jobs.remarks AS `Jobs__remarks`,
			Jobs.url AS `Jobs__url`,
			Jobs.seo_description AS `Jobs__seo_description`,
			Jobs.seo_keywords AS `Jobs__seo_keywords`,
			Jobs.sort_order AS `Jobs__sort_order`,
			Jobs.publish_status AS `Jobs__publish_status`,
			Jobs.version AS `Jobs__version`,
			Jobs.created_by AS `Jobs__created_by`,
			Jobs.created AS `Jobs__created`,
			Jobs.modified AS `Jobs__modified`,
			Jobs.deleted AS `Jobs__deleted`,
			'' AS `JobCategories__id`,
			'' AS `JobCategories__name`,
			'' AS `JobCategories__sort_order`,
			'' AS `JobCategories__created_by`,
			'' AS `JobCategories__created`,
			'' AS `JobCategories__modified`,
			'' AS `JobCategories__deleted`,
			'' AS `JobTypes__id`,
			'' AS `JobTypes__name`,
			'' AS `JobTypes__job_category_id`,
			'' AS `JobTypes__sort_order`,
			'' AS `JobTypes__created_by`,
			'' AS `JobTypes__created`,
			'' AS `JobTypes__modified`,
			'' AS `JobTypes__deleted`
		FROM jobs Jobs
		LEFT JOIN jobs_basic_abilities JobsBasicAbilities ON Jobs.id = (JobsBasicAbilities.job_id)
		LEFT JOIN basic_abilities BasicAbilities ON (BasicAbilities.id = (JobsBasicAbilities.basic_ability_id) AND (BasicAbilities.status = 1))
		WHERE (
			BasicAbilities.name LIKE '%キャビンアテンダント%'
			AND Jobs.publish_status = 1
			AND Jobs.status = 1)

		UNION ALL 

		SELECT 
			Jobs.id AS `Jobs__id`,
			Jobs.name AS `Jobs__name`,
			Jobs.media_id AS `Jobs__media_id`,
			'' AS `Jobs__job_category_id`,
			'' AS `Jobs__job_type_id`,
			Jobs.description AS `Jobs__description`,
			Jobs.detail AS `Jobs__detail`,
			Jobs.business_skill AS `Jobs__business_skill`,
			Jobs.knowledge AS `Jobs__knowledge`,
			Jobs.location AS `Jobs__location`,
			Jobs.activity AS `Jobs__activity`,
			Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
			Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
			Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
			Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
			Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
			Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
			Jobs.salary_range_average AS `Jobs__salary_range_average`,
			Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
			Jobs.restriction AS `Jobs__restriction`,
			Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
			Jobs.remarks AS `Jobs__remarks`,
			Jobs.url AS `Jobs__url`,
			Jobs.seo_description AS `Jobs__seo_description`,
			Jobs.seo_keywords AS `Jobs__seo_keywords`,
			Jobs.sort_order AS `Jobs__sort_order`,
			Jobs.publish_status AS `Jobs__publish_status`,
			Jobs.version AS `Jobs__version`,
			Jobs.created_by AS `Jobs__created_by`,
			Jobs.created AS `Jobs__created`,
			Jobs.modified AS `Jobs__modified`,
			Jobs.deleted AS `Jobs__deleted`,
			'' AS `JobCategories__id`,
			'' AS `JobCategories__name`,
			'' AS `JobCategories__sort_order`,
			'' AS `JobCategories__created_by`,
			'' AS `JobCategories__created`,
			'' AS `JobCategories__modified`,
			'' AS `JobCategories__deleted`,
			'' AS `JobTypes__id`,
			'' AS `JobTypes__name`,
			'' AS `JobTypes__job_category_id`,
			'' AS `JobTypes__sort_order`,
			'' AS `JobTypes__created_by`,
			'' AS `JobTypes__created`,
			'' AS `JobTypes__modified`,
			'' AS `JobTypes__deleted`
		FROM jobs Jobs
		LEFT JOIN jobs_tools JobsTools ON Jobs.id = (JobsTools.job_id)
		LEFT JOIN affiliates Tools ON (Tools.type = 1 AND Tools.id = (JobsTools.affiliate_id) AND (Tools.status = 1))
		WHERE (
			Tools.name LIKE '%キャビンアテンダント%'
			AND Jobs.publish_status = 1
			AND Jobs.status = 1)

		UNION ALL


		SELECT 
			Jobs.id AS `Jobs__id`,
			Jobs.name AS `Jobs__name`,
			Jobs.media_id AS `Jobs__media_id`,
			'' AS `Jobs__job_category_id`,
			'' AS `Jobs__job_type_id`,
			Jobs.description AS `Jobs__description`,
			Jobs.detail AS `Jobs__detail`,
			Jobs.business_skill AS `Jobs__business_skill`,
			Jobs.knowledge AS `Jobs__knowledge`,
			Jobs.location AS `Jobs__location`,
			Jobs.activity AS `Jobs__activity`,
			Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
			Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
			Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
			Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
			Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
			Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
			Jobs.salary_range_average AS `Jobs__salary_range_average`,
			Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
			Jobs.restriction AS `Jobs__restriction`,
			Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
			Jobs.remarks AS `Jobs__remarks`,
			Jobs.url AS `Jobs__url`,
			Jobs.seo_description AS `Jobs__seo_description`,
			Jobs.seo_keywords AS `Jobs__seo_keywords`,
			Jobs.sort_order AS `Jobs__sort_order`,
			Jobs.publish_status AS `Jobs__publish_status`,
			Jobs.version AS `Jobs__version`,
			Jobs.created_by AS `Jobs__created_by`,
			Jobs.created AS `Jobs__created`,
			Jobs.modified AS `Jobs__modified`,
			Jobs.deleted AS `Jobs__deleted`,
			'' AS `JobCategories__id`,
			'' AS `JobCategories__name`,
			'' AS `JobCategories__sort_order`,
			'' AS `JobCategories__created_by`,
			'' AS `JobCategories__created`,
			'' AS `JobCategories__modified`,
			'' AS `JobCategories__deleted`,
			'' AS `JobTypes__id`,
			'' AS `JobTypes__name`,
			'' AS `JobTypes__job_category_id`,
			'' AS `JobTypes__sort_order`,
			'' AS `JobTypes__created_by`,
			'' AS `JobTypes__created`,
			'' AS `JobTypes__modified`,
			'' AS `JobTypes__deleted`
		FROM jobs Jobs
		LEFT JOIN jobs_rec_qualifications JobsRecQualifications ON Jobs.id = (JobsRecQualifications.job_id)
		LEFT JOIN affiliates RecQualifications ON (RecQualifications.type = 2 AND RecQualifications.id = (JobsRecQualifications.affiliate_id) AND (RecQualifications.status = 1))
		WHERE (
			RecQualifications.name LIKE '%キャビンアテンダント%'
			AND Jobs.publish_status = 1
			AND Jobs.status = 1)

		UNION ALL 


		SELECT 
			Jobs.id AS `Jobs__id`,
			Jobs.name AS `Jobs__name`,
			Jobs.media_id AS `Jobs__media_id`,
			'' AS `Jobs__job_category_id`,
			'' AS `Jobs__job_type_id`,
			Jobs.description AS `Jobs__description`,
			Jobs.detail AS `Jobs__detail`,
			Jobs.business_skill AS `Jobs__business_skill`,
			Jobs.knowledge AS `Jobs__knowledge`,
			Jobs.location AS `Jobs__location`,
			Jobs.activity AS `Jobs__activity`,
			Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
			Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
			Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
			Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
			Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
			Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
			Jobs.salary_range_average AS `Jobs__salary_range_average`,
			Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
			Jobs.restriction AS `Jobs__restriction`,
			Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
			Jobs.remarks AS `Jobs__remarks`,
			Jobs.url AS `Jobs__url`,
			Jobs.seo_description AS `Jobs__seo_description`,
			Jobs.seo_keywords AS `Jobs__seo_keywords`,
			Jobs.sort_order AS `Jobs__sort_order`,
			Jobs.publish_status AS `Jobs__publish_status`,
			Jobs.version AS `Jobs__version`,
			Jobs.created_by AS `Jobs__created_by`,
			Jobs.created AS `Jobs__created`,
			Jobs.modified AS `Jobs__modified`,
			Jobs.deleted AS `Jobs__deleted`,
			'' AS `JobCategories__id`,
			'' AS `JobCategories__name`,
			'' AS `JobCategories__sort_order`,
			'' AS `JobCategories__created_by`,
			'' AS `JobCategories__created`,
			'' AS `JobCategories__modified`,
			'' AS `JobCategories__deleted`,
			'' AS `JobTypes__id`,
			'' AS `JobTypes__name`,
			'' AS `JobTypes__job_category_id`,
			'' AS `JobTypes__sort_order`,
			'' AS `JobTypes__created_by`,
			'' AS `JobTypes__created`,
			'' AS `JobTypes__modified`,
			'' AS `JobTypes__deleted`
		FROM jobs Jobs
		LEFT JOIN jobs_req_qualifications JobsReqQualifications ON Jobs.id = (JobsReqQualifications.job_id)
		LEFT JOIN affiliates ReqQualifications ON (ReqQualifications.type = 2 AND ReqQualifications.id = (JobsReqQualifications.affiliate_id) AND (ReqQualifications.status = 1))
		WHERE (
			ReqQualifications.name LIKE '%キャビンアテンダント%'
			AND Jobs.publish_status = 1
			AND Jobs.status = 1)
	) AS t

	GROUP BY t.Jobs__id
	ORDER BY t.Jobs__sort_order desc, t.Jobs__id DESC 
	LIMIT 50 OFFSET 0

-- END --

Example 2: Full-Text-Search
========================================================================================================================================================

-- START --

	SELECT 
	Jobs.id AS `Jobs__id`,
	Jobs.name AS `Jobs__name`,
	Jobs.media_id AS `Jobs__media_id`,
	Jobs.job_category_id AS `Jobs__job_category_id`,
	Jobs.job_type_id AS `Jobs__job_type_id`,
	Jobs.description AS `Jobs__description`,
	Jobs.detail AS `Jobs__detail`,
	Jobs.business_skill AS `Jobs__business_skill`,
	Jobs.knowledge AS `Jobs__knowledge`,
	Jobs.location AS `Jobs__location`,
	Jobs.activity AS `Jobs__activity`,
	Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
	Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
	Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
	Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
	Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
	Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
	Jobs.salary_range_average AS `Jobs__salary_range_average`,
	Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
	Jobs.restriction AS `Jobs__restriction`,
	Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
	Jobs.remarks AS `Jobs__remarks`,
	Jobs.url AS `Jobs__url`,
	Jobs.seo_description AS `Jobs__seo_description`,
	Jobs.seo_keywords AS `Jobs__seo_keywords`,
	Jobs.sort_order AS `Jobs__sort_order`,
	Jobs.publish_status AS `Jobs__publish_status`,
	Jobs.version AS `Jobs__version`,
	Jobs.created_by AS `Jobs__created_by`,
	Jobs.created AS `Jobs__created`,
	Jobs.modified AS `Jobs__modified`,
	Jobs.deleted AS `Jobs__deleted`,
	JobCategories.id AS `JobCategories__id`,
	JobCategories.name AS `JobCategories__name`,
	JobCategories.sort_order AS `JobCategories__sort_order`,
	JobCategories.created_by AS `JobCategories__created_by`,
	JobCategories.created AS `JobCategories__created`,
	JobCategories.modified AS `JobCategories__modified`,
	JobCategories.deleted AS `JobCategories__deleted`,
	JobTypes.id AS `JobTypes__id`,
	JobTypes.name AS `JobTypes__name`,
	JobTypes.job_category_id AS `JobTypes__job_category_id`,
	JobTypes.sort_order AS `JobTypes__sort_order`,
	JobTypes.created_by AS `JobTypes__created_by`,
	JobTypes.created AS `JobTypes__created`,
	JobTypes.modified AS `JobTypes__modified`,
	JobTypes.deleted AS `JobTypes__deleted`
	FROM jobs Jobs
	LEFT JOIN jobs_personalities JobsPersonalities ON Jobs.id = (JobsPersonalities.job_id)
	LEFT JOIN personalities Personalities ON (Personalities.id = (JobsPersonalities.personality_id) AND (Personalities.status = 1)) 
	LEFT JOIN jobs_practical_skills JobsPracticalSkills ON Jobs.id = (JobsPracticalSkills.job_id)
	LEFT JOIN practical_skills PracticalSkills ON (PracticalSkills.id = (JobsPracticalSkills.practical_skill_id) AND (PracticalSkills.status = 1))
	LEFT JOIN jobs_basic_abilities JobsBasicAbilities ON Jobs.id = (JobsBasicAbilities.job_id)
	LEFT JOIN basic_abilities BasicAbilities ON (BasicAbilities.id = (JobsBasicAbilities.basic_ability_id) AND (BasicAbilities.status = 1))
	LEFT JOIN jobs_tools JobsTools ON Jobs.id = (JobsTools.job_id)
	LEFT JOIN affiliates Tools ON (Tools.type = 1 AND Tools.id = (JobsTools.affiliate_id) AND (Tools.status = 1))
	LEFT JOIN jobs_career_paths JobsCareerPaths ON Jobs.id = (JobsCareerPaths.job_id)
	LEFT JOIN affiliates CareerPaths ON (CareerPaths.type = 3 AND CareerPaths.id = (JobsCareerPaths.affiliate_id) AND (CareerPaths.status = 1))
	LEFT JOIN jobs_rec_qualifications JobsRecQualifications ON Jobs.id = (JobsRecQualifications.job_id)
	LEFT JOIN affiliates RecQualifications ON (RecQualifications.type = 2 AND RecQualifications.id = (JobsRecQualifications.affiliate_id) AND (RecQualifications.status = 1))
	LEFT JOIN jobs_req_qualifications JobsReqQualifications ON Jobs.id = (JobsReqQualifications.job_id)
	LEFT JOIN affiliates ReqQualifications ON (ReqQualifications.type = 2 AND ReqQualifications.id = (JobsReqQualifications.affiliate_id) AND (ReqQualifications.status = 1))
	INNER JOIN job_categories JobCategories ON (JobCategories.id = (Jobs.job_category_id) AND (JobCategories.status = 1))
	INNER JOIN job_types JobTypes ON (JobTypes.id = (Jobs.job_type_id) AND (JobTypes.status = 1))
	WHERE (
	(
		match(JobCategories.name) AGAINST ('キャビンアテンダント')
		OR match(JobTypes.name) AGAINST ('キャビンアテンダント')
		OR match( Jobs.name, Jobs.description, Jobs.detail, Jobs.business_skill, Jobs.knowledge, Jobs.location, Jobs.activity, Jobs.salary_statistic_group, Jobs.salary_range_remarks, Jobs.restriction, Jobs.remarks	) AGAINST ('キャビンアテンダント') 
		OR match(Personalities.name) AGAINST ('キャビンアテンダント')
		OR match(PracticalSkills.name) AGAINST ('キャビンアテンダント')
		OR match(BasicAbilities.name) AGAINST ('キャビンアテンダント')
		OR match(Tools.name) AGAINST ('キャビンアテンダント')
		OR match(CareerPaths.name) AGAINST ('キャビンアテンダント')
		OR match(RecQualifications.name) AGAINST ('キャビンアテンダント')
		OR match(ReqQualifications.name) AGAINST ('キャビンアテンダント')
	) 
	AND Jobs.publish_status = 1
	AND Jobs.status = 1)
	GROUP BY Jobs.id
	ORDER BY Jobs.sort_order desc, Jobs.id DESC 
	LIMIT 50 OFFSET 0

-- END --
