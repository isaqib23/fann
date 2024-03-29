let campaign = {
    url                           : 'campaign',

    get                           : 'get.json',
    save                          : 'save',
    delete                        : 'delete/:id',
    objectives                    : 'objectives',
    allPlacements                 : 'allPlacements',
    savePlacementAndPaymentType   : 'savePlacementAndPaymentType',
    saveTouchPoint                : 'saveTouchPoint',
    saveInvitation                : 'saveInvitation',
    getCampaignTouchPoint         : 'getCampaignTouchPoint',
    getCampaignSavedObjective     : 'getCampaignSavedObjective',
    updateCampaignStatus          : 'updateCampaignStatus',
    getActiveCampaignsByCompany   : 'manage/getActiveCampaignsByCompany',
    getActiveCampaigns            : 'manage/getActiveCampaigns',
    getCampaignById               : 'manage/getCampaignById',
    getCampaignProposals          : 'manage/getCampaignProposals',
    getInfluencerAssignTouchPoint : 'manage/getInfluencerAssignTouchPoint',
    getInfluencerCampaign         : 'manage/getInfluencerCampaign'
};

export default campaign;
