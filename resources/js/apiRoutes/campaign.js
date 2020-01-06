let campaign = {
    url                         : 'campaign',

    get                         : 'get.json',
    save                        : 'save',
    delete                      : 'delete/:id',
    objectives                  : 'objectives',
    allPlacements               : 'allPlacements',
    savePlacementAndPaymentType : 'savePlacementAndPaymentType',
    saveTouchPoint              : 'saveTouchPoint',
    saveInvitation              : 'saveInvitation',
    getCampaignTouchPoint       : 'getCampaignTouchPoint',
    getCampaignSavedObjective   : 'getCampaignSavedObjective',
    updateCampaignStatus        : 'updateCampaignStatus',
    getActiveCampaigns          : 'manage/getActiveCampaigns',
    getCampaignById             : 'manage/getCampaignById',
    getCampaignProposal         : 'manage/getCampaignProposal'
};

export default campaign;
